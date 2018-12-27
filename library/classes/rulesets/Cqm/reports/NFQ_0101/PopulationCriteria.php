<?php

 
class NFQ_0101_PopulationCriteria implements CqmPopulationCrtiteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new NFQ_0101_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new NFQ_0101_Numerator();
    }
    
    public function createDenominator()
    {
        return new NFQ_0101_Denominator();
    }
    
    public function createExclusion()
    {
        return new ExclusionsNone();
    }
    
    public function createDenominatorException()
    {
        return new NFQ_0101_DenominatorException();
    }
}
