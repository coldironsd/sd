<?php

namespace AppBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class DateTimeTransformer implements DataTransformerInterface
{
    /**
     * Transforms an object (DateTime) to a string.
     *
     * @param  DateTime|null $datetime
     * @return string
     */
    public function transform($datetime)
    {
        if (null === $datetime) {
            return 'EMPTY';
        }

        return $datetime->format('d/m/Y H:i');
    }

    /**
     * Transforms a string to an object (DateTime).
     *
     * @param  string $datetime
     * @return DateTime|null
     */
    public function reverseTransform($datetime)
    {
        // datetime optional
        if (!$datetime) {
            echo 'EMPTY';
            return 'EMPTY';
        }

        return date_create_from_format('d/m/Y H:i', $datetime, new \DateTimeZone('America/New_York'));
    }
}