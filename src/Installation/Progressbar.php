<?php

namespace Travian\Installation;

class Progressbar
{

    protected $bar_id;

    protected $max_ticks;

    protected $ticks;

    protected $label;

    public function __construct($max_ticks, $label = '%d van %d')
    {
        $this->bar_id = uniqid('progressbar');
        $this->label = $label;

        $this->max_ticks = $max_ticks;
        $this->ticks = 0;
    }

    public function tick()
    {
        $this->ticks++;
        $this->draw_progress();
    }

    public function draw()
    {
        $this->draw_bar();
        $this->draw_progress();
    }

    static public function draw_css()
    {
        echo '
			<style type="text/css">
			.ihg_progress_bar {
				display: block;
				width: 500px;
				height: 20px;
				border: 1px solid gray;
				padding: 1px;

				margin: 3px auto;

				position: relative;
			}

			.ihg_progress_ticks {
				display: block;
				position: absolute;

				background-color: orange;
				width: 0;
				height: 20px;
				overflow: hidden;
			}

			.ihg_progress_label_a,
			.ihg_progress_label_b {
				display: block;
				position: absolute;

				width: 500px;
				height: 20px;
				text-align: center;
			}

			.ihg_progress_label_a {
				color: black;
			}

			.ihg_progress_label_b {
				color: white;
			}
			</style>
		';
    }

    protected function draw_bar()
    {
        echo '
			<div class="ihg_progress_bar">
				<span class="ihg_progress_label_a" id="' . $this->bar_id . '_label_a"></span>
				<div class="ihg_progress_ticks" id="' . $this->bar_id . '">
					<span class="ihg_progress_label_b" id="' . $this->bar_id . '_label_b"></span>
				</div>
			</div>
		';
        echo '
			<script type="text/javascript">
			(function() {
				var bar        = document.getElementById("' . $this->bar_id . '");
				var label_a = document.getElementById("' . $this->bar_id . '_label_a");
				var label_b = document.getElementById("' . $this->bar_id . '_label_b");

				window["' . $this->bar_id . '"] = function(width, label) {
					bar.style.width = width + "%";
					label_a.innerHTML = label;
					label_b.innerHTML = label;
				}
			})();
			</script>
		';

        $this->flush();
    }

    protected function draw_progress()
    {

        $width = round($this->ticks / $this->max_ticks * 100, 2);
        $label = sprintf($this->label, $this->ticks, $this->max_ticks);

        echo '
			<script type="text/javascript">
				window["' . $this->bar_id . '"]("' . $width . '", "' . addslashes($label) . '");
			</script>

		';
        $this->flush();
    }

    protected function flush()
    {
        while (ob_get_level() > 0) {
            ob_end_flush();
        }

        flush();
    }
}