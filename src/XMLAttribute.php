<?php

declare(strict_types=1);

namespace SimpleSAML\XML;

use DOMAttr;
use DOMDocument;
use SimpleSAML\Assert\Assert;

/**
 * Class to represent an arbitrary namespaced attribute.
 *
 * @package simplesamlphp/xml-common
 */
final class XMLAttribute implements ArrayizableElementInterface
{
    /**
     * Create na XMLAttribute element.
     *
     * @param string|null $namespaceURI
     * @param string $namespacePrefix
     * @param string $attrName
     * @param string $attrValue
     */
    public function __construct(
        protected ?string $namespaceURI,
        protected string $namespacePrefix,
        protected string $attrName,
        protected string $attrValue,
    ) {
        Assert::nullOrStringNotEmpty($namespaceURI);
        Assert::stringNotEmpty($namespacePrefix);
        Assert::notSame('xmlns', $namespacePrefix);
        Assert::stringNotEmpty($attrName);
        Assert::stringNotEmpty($attrValue);
    }


    /**
     * Collect the value of the namespaceURI-property
     *
     * @return string|null
     */
    public function getNamespaceURI(): ?string
    {
        return $this->namespaceURI;
    }


    /**
     * Collect the value of the namespacePrefix-property
     *
     * @return string
     */
    public function getNamespacePrefix(): string
    {
        return $this->namespacePrefix;
    }


    /**
     * Collect the value of the localName-property
     *
     * @return string
     */
    public function getAttrName(): string
    {
        return $this->attrName;
    }


    /**
     * Collect the value of the value-property
     *
     * @return string
     */
    public function getAttrValue(): string
    {
        return $this->attrValue;
    }


    /**
     * Create a class from XML
     *
     * @param \DOMAttr $xml
     * @return static
     */
    public static function fromXML(DOMAttr $attr): static
    {
        return new static($attr->namespaceURI, $attr->prefix, $attr->localName, $attr->value);
    }


    /**
     * Create XML from this class
     *
     * @return \DOMAttr
     */
    public function toXML(): DOMAttr
    {
        $doc = new DOMDocument('1.0', 'UTF-8');

        $elt = $doc->createElement("placeholder");
        $elt->setAttributeNS($this->getNamespaceURI(), $this->getAttrName(), $this->getAttrValue());

        /** @psalm-var \DOMAttr $ret */
        $ret = $elt->getAttributeNode($this->getAttrName());
        return $ret;
    }


    /**
     * Create a class from an array
     *
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        Assert::keyExists($data, 'namespaceURI');
        Assert::keyExists($data, 'namespacePrefix');
        Assert::keyExists($data, 'attrName');
        Assert::keyExists($data, 'attrValue');

        Assert::string($data['namespaceURI']);
        Assert::string($data['namespacePrefix']);
        Assert::string($data['attrName']);
        Assert::string($data['attrValue']);

        return new static(
            $data['namespaceURI'],
            $data['namespacePrefix'],
            $data['attrName'],
            $data['attrValue'],
        );
    }


    /**
     * Create an array from this class
     *
     * @return array{attrName: string, attrValue: string, namespacePrefix: string, namespaceURI: null|string}
     */
    public function toArray(): array
    {
        return [
            'namespaceURI' => $this->getNamespaceURI(),
            'namespacePrefix' => $this->getNamespacePrefix(),
            'attrName' => $this->getAttrName(),
            'attrValue' => $this->getAttrValue(),
        ];
    }
}
