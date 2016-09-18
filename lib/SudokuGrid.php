<?php
class SudokuGrid
{
    protected $grid;

    public function __construct($data, $error) {
        $this->grid = $data;
        $this->error = $error;
    }

    /**
     * build grid based on form submit
     * @return method
     */
    public function makeGrid() {
        if (!empty($this->grid)) {
            return $this->customGrid();
        } else {
            return $this->buildGrid();
        }
    }

    /**
     * build default grid when no form submitted
     * @return string
     */
    protected function buildGrid() {
        $count = 111;
        $html = '<form action="" method="post">';
        for ($x = 1; $x <= 9; $x++) {

            if ($x === 4 || $x === 7) {
                $count += 3;
            }

            for ($y = 1; $y <= 9; $y++) {
                $html .= '<div class="cell"><input type="text" class="input" maxlength="1" name="' . $count . '" autocomplete="off"></div>';
                if ($y === 9) {
                    $count += 18;
                } elseif ($y === 3 || $y === 6) {
                    $count += 11;
                } else {
                    $count += 10;
                }
            }
        }

        $html .= '<div id="form_submit"><div id="submit"><input type="submit" value="Solve"></div></div></form>';

        return $html;
    }

    /**
     * build custom grid when form submitted
     * @return string
     */
    protected function customGrid() {
        $html = '<form action="" method="post">';
        foreach($this->grid as $key => $value) {
            $html .= '<div class="cell"><input type="text" class="input" maxlength="1" name="' . $key . '" value="' . $value . '" autocomplete="off"></div>';
        }

        $html .= '<div id="form_submit"><div id="error_message">' . $this->error . '</div><div id="submit"><input type="submit" value="Solve"></div></div></form>';
        
        return $html;
    }
}
?>
