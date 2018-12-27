<?php

class NFQ_0101 extends AbstractCqmReport
{
    public function createPopulationCriteria()
    {
         return new NFQ_0101_PopulationCriteria();
    }
}
