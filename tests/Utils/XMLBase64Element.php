<?php

declare(strict_types=1);

namespace SimpleSAML\Test\XML;

use SimpleSAML\XML\AbstractXMLElement;
use SimpleSAML\XML\XMLBase64ElementTrait;

/**
 * Empty shell class for testing XMLBase64Element.
 *
 * @package simplesaml/xml-security
 */
final class XMLBase64Element extends AbstractXMLElement
{
    use XMLBase64ElementTrait;

    /** @var string */
    public const NS = 'foo';

    /** @var string */
    public const NS_PREFIX = 'bar';
}
