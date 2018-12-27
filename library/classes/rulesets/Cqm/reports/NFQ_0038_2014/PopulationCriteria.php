<?php


class NFQ_0038_2014_PopulationCriteria implements CqmPopulationCrtiteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new NFQ_0038_2014_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new NFQ_0038_2014_Numerator();
    }
    
    public function createDenominator()
    {
        return new NFQ_0038_2014_Denominator();
    }
    
    public function createExclusion()
    {
        return new ExclusionsNone();
    }
    
    public function createDenominatorException()
    {
        return new ExceptionsNone();
    }
}
