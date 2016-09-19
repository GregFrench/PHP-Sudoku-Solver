<?php
class SudokuSolver
{
    protected $error = "";

    /**
	 * constructor method to divide grid into rows, columns, and boxes
	 */
    public function __construct($data) {
        $this->data = $data;
        $this->rows = array();
        $this->cols = array();
        $this->boxes = array();

        if (!empty($this->data)) {
            foreach ($this->data as $key => $value) {
                $value = (int) $value;
                $this->rows[substr($key, 0, 1)][] = $value;
                $this->cols[substr($key, 1, 1)][] = $value;
                $this->boxes[substr($key, 2, 1)][] = $value;
            }
        }
    }

    /**
	 * validation method to check if puzzle is valid
	 * @return array 
	 */
    public function validate() {
        if ($this->checkRowDuplicates() === false || $this->checkColDuplicates() === false || $this->checkBoxDuplicates() === false) {
            $this->error = "Unsolvable puzzle.";

            // reset 0 values to empty if puzzle unsolvable
            foreach ($this->data as $key => $value) {
                if ($value === 0) {
                    $this->data[$key] = "";
                }
            }

            return $this->data;
        }
    }

    /**
	 * validate rows
	 */
    protected function checkRowDuplicates() {
        foreach ($this->rows as $key => $value) {
            $values = array();
            foreach ($this->rows[$key] as $key => $value) {
                if ($value > 0 && in_array($value, $values)) {
                    return false;
                } else {
                    $values[] = $value;
                }
            }
        }
    }

    /**
	 * validate columns
	 */
    protected function checkColDuplicates() {
        foreach ($this->cols as $key => $value) {
            $values = array();
            foreach ($this->cols[$key] as $key => $value) {
                if ($value > 0 && in_array($value, $values)) {
                    return false;
                } else {
                    $values[] = $value;
                }
            }
        }
    }

    /**
	 * validate boxes
	 */
    protected function checkBoxDuplicates() {
        foreach ($this->boxes as $key => $value) {
            $values = array();
            foreach ($this->boxes[$key] as $key => $value) {
                if ($value > 0 && in_array($value, $values)) {
                    return false;
                } else {
                    $values[] = $value;
                }
            }
        }
    }

    public function getError() {
        return $this->error;
    }

    /**
	 * solve method to solve the soduoku using the brute force algorithm.
	 * @return array
	 */
    public function solve() {
        $keys = $this->getKeys();
        $x = 0;

        while ($x < count($keys)) {
            if ($this->data[$keys[$x]] === "") {
                $start = 1;
            } else {
                $start = $this->data[$keys[$x]];
            }
            for ($y = $start; $y <= 9; $y += 1) {

                if ($this->checkRow(substr($keys[$x], 0, 1), $y) === false && $this->checkCol(substr($keys[$x], 1, 1), $y) === false && $this->checkBox(substr($keys[$x], 2, 1), $y) === false) {

                    $this->data[$keys[$x]] = $y;
                    $x += 1;
                    break;
                }

                if ($y === 9) {
                    $this->data[$keys[$x]] = "";
                    $x -= 1;
                }
            }
        }

        return $this->data;
    }

    /**
	 * put empty keys into a array
	 * @return array
	 */
    protected function getKeys() {
        $keys = array();

        foreach ($this->data as $key => $value) {
            if (!$value > 0) {
                $keys[] = $key;
            }
        }

        return $keys;
    }

    /**
     * @param string $row
     * @param int $num 
     * @return bool 
     */
    protected function checkRow($row, $num) {
        $values = array();
        foreach ($this->data as $key => $value) {
            if (substr($key, 0, 1) === $row) {
                $values[] = $value;
            }
        }
        return in_array($num, $values);
    }

    /**
     * @param string $col
     * @param int $num 
     * @return bool 
     */
    protected function checkCol($col, $num) {
        $values = array();
        foreach ($this->data as $key => $value) {
            if (substr($key, 1, 1) === $col) {
                $values[] = $value;
            }
        }
        return in_array($num, $values);
    }

    /**
     * @param string $box
     * @param int $num 
     * @return bool 
     */
    protected function checkBox($box, $num) {
        $values = array();
        foreach ($this->data as $key => $value) {
            if (substr($key, 2, 1) === $box) {
                $values[] = $value;
            }
        }
        return in_array($num, $values);
    }
}
?>
