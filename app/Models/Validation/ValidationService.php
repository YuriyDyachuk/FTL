<?php


namespace App\Models\Validation;


abstract class ValidationService
{
    protected $rules = [];
    protected $messages = [];

    public function setRulesWithMessage($ruleCode, $ruleValue, $messageCode, $message)
    {
        $this->setRules($ruleCode, $ruleValue);
        $this->setMessages($messageCode, $message);
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setRules($key, $value): void
    {
        $this->rules[$key] = $value;
    }

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function setMessages($key, $value): void
    {
        $this->messages[$key] = $value;
    }

    public function getUniqueMessages(array $messages):array
    {
        $results = [];
        foreach ($messages as $key => $message) {
            if(!in_array($message, $results)){
                $results[$key] = $message;
            }
        }

        return $results;
    }
}
