<?php

 
class NFQ_0002_PopulationCriteria implements CqmPopulationCrtiteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new NFQ_0002_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new NFQ_0002_Numerator();
    }
    
    public function createDenominator()
    {
        return new NFQ_0002_Denominator();
    }
    
    public function createExclusion()
    {
        return new NFQ_0002_Exclusion();
    }
    
    public function createDenominatorException()
    {
        return new ExceptionsNone();
    }
}
