<?php

/**
 * This file is part of <http://www.cogsci.nl>.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
**/

require_once("libgabor.php");

if (array_key_exists("generate", $_GET)) {
	$orient = $_GET["orient"];
	$size = $_GET["size"];
	$std = $_GET["std"];
	$env = $_GET["env"];
	$freq = $_GET["freq"];
	$phase = $_GET["phase"];
	$red0 = $_GET["red0"];
	$green0 = $_GET["green0"];
	$blue0 = $_GET["blue0"];
	$red1 = $_GET["red1"];
	$green1 = $_GET["green1"];
	$blue1 = $_GET["blue1"];
	$red2 = $_GET["red2"];
	$green2 = $_GET["green2"];
	$blue2 = $_GET["blue2"];
} else {
	$orient = 45;
	$std = 12;
	$size = 8 * $std;
	$env = "gaussian";
	$freq = 0.1;
	$phase = 0.0;
	$red0 = 128;
	$green0 = 128;
	$blue0 = 128;
	$red1 = 255;
	$green1 = 255;
	$blue1 = 255;
	$red2 = 0;
	$green2 = 0;
	$blue2 = 0;
}

?>

<p>
Gabor patches are sinusoidal gratings, typically with a Gaussian envelope, which are frequently used as stimuli in psychological experiments. Using this page you can easily create and download high quality Gabor patches.
As with most topics, you can find out more about Gabor patches on <a href="http://en.wikipedia.org/wiki/Gabor_filter" target="newwindow">Wikipedia</a>.
</p>

<p>
In order to generate multiple Gabor patches at once, you can enter multiple values separated by a comma (",").
You can download generated stimuli separately or at once as a .zip file.
Please note that the script may time out if you generate too many or very large stimuli.
</p>

<p>
If you are here in the hope of training your eyesight, see <a href='http://www.cogsci.nl/blog/miscellaneous/226-can-you-brain-train-your-way-to-perfect-eyesight'>this post</a> for a critical discussion of recent claims that visual training with Gabor patches improves vision.
</p>

<h2>Specify and generate</h2>

<?php require("gaborform.php"); ?>

<h2>View and download</h2>

<?php

error_reporting(E_ALL);

$zipfile = "tmp/gabor-" . rand() . ".zip";
$zip = new ZipArchive();
if ($zip->open($zipfile, ZIPARCHIVE::CREATE)!==TRUE) {
    print "<p><b>Warning:</b> failed to create zip archive!</p>\n";
}

echo "<p align=\"center\"><a href=\"$zipfile\">Download all patches as a .zip file</a></p>\n";

echo "<table width=\"100%\" class=\"defaulttable\">\n";

foreach (explode(",", $orient) as $_orient) {
	$_orient = floatval($_orient);
	foreach (explode(",", $size) as $_size) {
		$_size = floatval($_size);
		foreach (explode(",", $std) as $_std) {
			$_std = floatval($_std);
			foreach (explode(",", $freq) as $_freq) {
				$_freq = floatval($_freq);
				foreach (explode(",", $phase) as $_phase) {
					$_phase = floatval($_phase);
					foreach (explode(",", $red0) as $_red0) {
						$_red0 = floatval($_red0);
						foreach (explode(",", $green0) as $_green0) {
							$_green0 = floatval($_green0);
							foreach (explode(",", $blue0) as $_blue0) {
								$_blue0 = floatval($_blue0);
								foreach (explode(",", $red1) as $_red1) {
									$_red1 = floatval($_red1);
									foreach (explode(",", $green1) as $_green1) {
										$_green1 = floatval($_green1);
										foreach (explode(",", $blue1) as $_blue1) {
											$_blue1 = floatval($_blue1);
											foreach (explode(",", $red2) as $_red2) {
												$_red2 = floatval($_red2);
												foreach (explode(",", $green2) as $_green2) {
													$_green2 = floatval($_green2);
													foreach (explode(",", $blue2) as $_blue2) {
														$_blue2 = floatval($_blue2);
														$color0 = array($_red0, $_green0, $_blue0);
														$color1 = array($_red1, $_green1, $_blue1);
														$color2 = array($_red2, $_green2, $_blue2);
														$fname = show_gabor($_orient, $_size, $_std, $_freq,
															$_phase, $color0, $color1, $color2, $env);
														$zip->addFile($fname);
													}
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
}
$zip->close();
echo "</table>\n";
?>
<p><i><a href='https://github.com/smathot/gabor-patch-generator'>Source code</a></i></p>
