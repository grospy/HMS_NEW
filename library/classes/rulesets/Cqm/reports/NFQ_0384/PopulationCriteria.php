<?php


class NFQ_0384_PopulationCriteria implements CqmPopulationCrtiteriaFactory
{
    public function getTitle()
    {
        return "Population Criteria";
    }
    
    public function createInitialPatientPopulation()
    {
        return new NFQ_0384_InitialPatientPopulation();
    }
    
    public function createNumerators()
    {
        return new NFQ_0384_Numerator();
    }
    
    public function createDenominator()
    {
        return new NFQ_0384_Denominator();
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
