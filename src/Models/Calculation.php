<?php

    interface Calculation
    {
        /**
         * Calculate items from textarea
         */
        public function calculate($str);
    }

    class Multi implements Calculation
    {
        /**
         * Multiplication
         */
        public function calculate($str)
        {
            return array_product($str);
        }
    }

    class Add implements Calculation
    {
        /**
         * Addition
         */
        public function calculate($str)
        {
            return array_sum($str);
        }
    }

    Class ParseText
    {
        public $array_of_numbers;

        public function __construct($array_of_numbers)
        {
            $this->array_of_numbers = $array_of_numbers;
        }

        public function parseText()
        {
            /**
             * Remove unnecessary spaces and crete array
             */
            $str = preg_replace('/\s+/', ' ', $this->array_of_numbers);
            $str = trim($str);
            $array_from_str = explode(" ", $str);
            return $array_from_str;
        }

        public function findOperation()
        {
            /**
             * The first in the array must be the operation.
             * We check whether it exists and whether it matches the available one
             */
            $errors = '';
            $ourOperations = ['Add', 'Multi']; // here we can add new operations
            $array_from_str = $this->parseText();
            $operation = ucfirst($array_from_str[0]);
            if(in_array($operation, $ourOperations)){
                return array($operation, $errors);
            }
            elseif (ctype_digit($operation)){
                $errors = 'You missed an operation, enter it first';
                return array($operation, $errors);
            }
            else {
                $errors = 'Operation ' . $operation .' does not exist, try another one!';
                return array($operation, $errors);
            }
        }

        public function findNumbers()
        {
            /**
             * Separate the part with numbers and check whether there are no invalid characters in it
             */
            $errors ='';
            $array_from_str = $this->parseText();
            array_shift($array_from_str);

            foreach ($array_from_str as $testcase) {
                if (!ctype_digit($testcase)) {
                    $errors = 'You entered the character ' . $testcase . ' delete it and continue!';
                    return array($testcase, $errors);
                }
            }
            sort($array_from_str, SORT_REGULAR  );
            return array($array_from_str, $errors);

        }
    }

    Class CalculateItems
    {
        /**
         * @var Calculation
         * We call the interface to calculate our operation
         */
        protected $transporter;
        protected $array_of_numbers;

        public function __construct(Calculation $transporter, $array_of_numbers)
        {
            $this->transporter = $transporter;
            $this->array_of_numbers = $array_of_numbers;
        }

        public function calculate()
        {
            return $this->transporter->calculate($this->array_of_numbers);
        }
    }
?>