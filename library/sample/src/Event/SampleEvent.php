<?php
/**
 * This file is part of OpenEMR.
 *
 * @link https://github.com/openemr/openemr/tree/master
 * @license https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Sample\Event;

use Symfony\Component\EventDispatcher\Event;


class SampleEvent extends Event
{
    const NAME = 'sample.event';
}
