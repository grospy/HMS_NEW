<?php


class NFQ_0002 extends AbstractCqmReport
{
    public function createPopulationCriteria()
    {
         return new NFQ_0002_PopulationCriteria();
    }
}
