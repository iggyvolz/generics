<?php

namespace Iggyvolz\Generics;

use iggyvolz\classgen\ClassGenerator;
use Iggyvolz\SimpleAttributeReflection\AttributeReflection;
use LogicException;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;
use PhpToken;
use ReflectionClass;
use ReflectionException;
use Stringable;

class ImplementationGenerator extends ClassGenerator
{
    /**
     * @throws ReflectionException
     */
    private static function reflectBaseClass(string $class): ?ReflectionClass
    {
        return new ReflectionClass(substr($class, 0, strpos($class, "«")));
    }
    private static function genericClass(string $class): ?Generic
    {
        return AttributeReflection::getAttribute(self::reflectBaseClass($class), Generic::class);
    }
    protected function isValid(string $class): bool
    {
        if(!str_contains($class, "«") || !str_contains($class, "»")) {
            return false;
        }
        try {
            if(!self::genericClass($class)) {
                return false;
            }
        } catch(ReflectionException) {
            return false;
        }
        return true;
    }

    public function generate(string $class): string|Stringable
    {
        $classT = ClassType::withBodiesFrom(self::reflectBaseClass($class)->getName());
        $classT->setName(substr($class, strrpos($class, "\\")+1));
        $namespace = substr($class, 0, strrpos($class, "\\"));
        $namespaceT = new PhpNamespace($namespace);
        $namespaceT->add($classT);
        // Parse the generic parameters
        $genericParamsRequested = self::genericClass($class)->classes;
        $genericParamsPassed = preg_split("/(?<=>),/", substr($class, strpos($class, "«")+2, -2));

        if(count($genericParamsRequested) !== count($genericParamsPassed)) {
            throw new LogicException(count($genericParamsPassed) . " params passed in $class but " . count($genericParams) . " required.");
        }
        $genericParams = [];
        foreach($genericParamsRequested as $i => $key) {
            $genericParams[$key] = $genericParamsPassed[$i];
        }
        // Add try { <push all params>} {
        // } finally { <pop all params> }
        // to all functions, so they can resolve class names in ::class()
        $preBody = "try {";
        foreach($genericParams as $genericParam => $genericParamPassed) {
            $preBody .= var_export($genericParam, true) ."::push(" . var_export($genericParamPassed, true) . ");";
        }
        $postBody = "\n} finally {";
        foreach($genericParams as $genericParam => $genericParamPassed) {
            $postBody .= var_export($genericParam, true) ."::pop();";
        }
        $postBody .= "}";
        foreach($classT->methods as $method) {
            $method->setBody($preBody . $method->getBody() . $postBody);
        }
        // for all methods, if they are annotated with the type, make the return type be that
        foreach($classT->methods as $method) {
            foreach($method->getAttributes() as $attribute) {
                $attributeName = $attribute->getName();
                if(array_key_exists($attributeName, $genericParams)) {
                    $method->setReturnType($genericParams[$attributeName]);
                }
            }
            // for all method parameter,s if they are annotated with the type, make the parameter type be that
            foreach($method->getParameters() as $parameter) {
                foreach($parameter->getAttributes() as $attribute) {
                    $attributeName = $attribute->getName();
                    if(array_key_exists($attributeName, $genericParams)) {
                        $parameter->setType($genericParams[$attributeName]);
                    }
                }
            }
        }
        return $namespaceT;
    }
}