<?php
namespace App\Services;

class StatusCheckService
{
    protected bool $manualResult = false;

    public function setResult(bool $result): void
    {
        $this->manualResult = $result;
    }

    public function checkCondition($value): bool
    {
        return $this->manualResult;
    }
}
?>