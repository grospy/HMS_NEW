<?php

class NFQ_0028_2014 extends AbstractCqmReport
{
    public function createPopulationCriteria()
    {
         return new NFQ_0028_2014_PopulationCriteria();
    }
}
