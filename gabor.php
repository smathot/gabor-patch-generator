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
 *
 * CHANGELOG
 *
 * Version 1.2
 * - Nov 15, 2010. Replaced the shell_exec(), which the service provider
 *   appears to have blocked, by the builtin zip class.
 *
**/

if (array_key_exists("generate", $_GET)) {
	$orient = $_GET["orient"];
	$size = $_GET["size"];
	$std = $_GET["std"];
	$env = $_GET["env"];
	$bgmode = $_GET["bgmode"];
	$freq = $_GET["freq"];
	$phase = $_GET["phase"];
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
	$bgmode = "average";
	$freq = 0.1;
	$phase = 0.0;
	$red1 = 255;
	$green1 = 255;
	$blue1 = 255;
	$red2 = 0;
	$green2 = 0;
	$blue2 = 0;
}

?>

<p>
Gabor patches are sinusoidal gratings, typically with a Gaussian envelope, which are frequently used as stimuli in psychological experiments.
Using this page you can easily create and download high quality Gabor patches.
As with most topics, you can find out more about Gabor patches on <a href="http://en.wikipedia.org/wiki/Gabor_filter" target="newwindow">Wikipedia</a>.
</p>

<p>
In order to generate multiple Gabor patches at once, you can enter multiple values separated by a comma (",").
You can download generated stimuli separately or at once as a .zip file.
Please note that the script may time out if you generate too many or very large stimuli.
</p>

<h2>Specify and generate</h2>

<!--form name="" method="get" action="index.php" -->
<form name="" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="option" value="com_content">
<input type="hidden" name="view" value="article">
<input type="hidden" name="Itemid" value="63">
<input type="hidden" name="id" value="50">
<input type="hidden" name="generate" value="yes">
<!-- input type="hidden" name="page" value="gabor-patch-generator" -->

<table class="defaulttable" width="100%">

<tr><td width="50%">
Orientation<br />
<small>in degrees</small>
</td><td>
<input type="text" name="orient" size=5 value="<?php echo  $orient ?>">
</td></tr>

<tr><td>
Size<br />
<small>in pixels</small>
</td><td>
<input type="text" name="size" size=5 value="<?php echo  $size ?>">
</td></tr>


<tr><td>
Envelope<br />
<small>Determines the shape of the patch, see
<a href="http://en.wikipedia.org/wiki/Window_function" target="_blank">
http://en.wikipedia.org/wiki/Window_function</a></small>
</td><td>

	<input type="radio" name="env" value="gaussian"
	<?php if ($env == "gaussian") { echo "checked=\"checked\""; } ?>
	> Gaussian <br />

	<input type="radio" name="env" value="linear"
	<?php if ($env == "linear") { echo "checked=\"checked\""; } ?>
	> Linear (triangular) <br />

	<input type="radio" name="env" value="cos"
	<?php if ($env == "cos") { echo "checked=\"checked\""; } ?>
	> Cosine (sine) <br />

	<input type="radio" name="env" value="hann"
	<?php if ($env == "hann") { echo "checked=\"checked\""; } ?>
	> Hann (raised cosine) <br />

	<input type="radio" name="env" value="hamming"
	<?php if ($env == "hamming") { echo "checked=\"checked\""; } ?>
	> Hamming (raised cosine) <br />

	<input type="radio" name="env" value="circle"
	<?php if ($env == "circle") { echo "checked=\"checked\""; } ?>
	> Circular (sharp edge) <br />

	<input type="radio" name="env" value="none"
	<?php if ($env == "none") { echo "checked=\"checked\""; } ?>
	> Rectangular (no envelope) <br />

</td></tr>


<tr><td>
Standard deviation<br />
<small>in pixels (only applies to the Gaussian envelope)</small>
</td><td>
<input type="text" name="std" size=5 value="<?php echo  $std ?>">
</td></tr>

<tr><td>
Frequency<br />
<small>in cycles/ pixel</small>
</td><td>
<input type="text" name="freq" size=5 value="<?php echo  $freq ?>">
</td></tr>

<tr><td>
Phase<br />
<small>in cycles (0-1)</small>
</td><td>
<input type="text" name="phase" size=5 value="<?php echo  $phase ?>">
</td></tr>

<tr><td>
Color 1<br />
<small>RGB values should be in the 0-255 range</small>
</td><td>
Red: <input type="text" name="red1" value="<?php echo  $red1 ?>" size=3>
Green: <input type="text" name="green1" value="<?php echo  $green1 ?>" size=3>
Blue: <input type="text" name="blue1" value="<?php echo  $blue1 ?>" size=3>
</td></tr>

<tr><td>
Color 2<br />
<small>RGB values should be in the 0-255 range</small>
</td><td>
Red: <input type="text" name="red2" value="<?php echo  $red2 ?>" size=3>
Green: <input type="text" name="green2" value="<?php echo  $green2 ?>" size=3>
Blue: <input type="text" name="blue2" value="<?php echo  $blue2 ?>" size=3>
</td></tr>

<tr><td>
Background color<br />
<small>Determines the color of the background</small>
</td><td>
<input type="radio" name="bgmode" value="average"
<?php if ($bgmode == "average") { echo "checked=\"checked\""; } ?>
> Average of color 1 and color 2<br />
<input type="radio" name="bgmode" value="color2"
<?php if ($bgmode == "color2") { echo "checked=\"checked\""; } ?>
> Same as color 2 <br />
</td></tr>

<tr><td colspan=2 align="center">
<input type="submit" value="Generate!">
</td></tr>

</table>

</form>

<h2>View and download</h2>

<?php

error_reporting(E_ALL);

function generate_gabor($orient, $size, $env, $bgmode, $std, $freq, $phase, $r1, $g1, $b1, $r2, $g2, $b2, $filetype, $outfile)
{
	// Convert the orientation to radians
	$orient = deg2rad($orient);

	// Convert the size to a factor of the standard deviation
	$_size = $size;
	$size = $size / $std;

	$pi = 3.14;

	$im = imagecreatetruecolor($std * $size, $std * $size) or die("Failed to create image");
	$bgcolor = imagecolorallocate($im, 0, 0, 0);

	for ($rx = 0; $rx < $std * $size; $rx++) {
		for ($ry = 0; $ry < $std * $size; $ry++) {

			$dx = $rx - 0.5 * $std * $size; // The dx from the center
			$dy = $ry - 0.5 * $std * $size; // The dy from the center

			$t = atan2($dy, $dx) + $orient; // The angle of the pixel
			$r = sqrt($dx * $dx + $dy * $dy); // The distance of the pixel from the center
			$x = $r * cos($t); // The x coordinate in the unrotated image
			$y = $r * sin($t); // The y coordinate in the unrotated image

			# The amplitude without envelope (from 0 to 1)
			$amp = 0.5 + 0.5 * cos(2 * $pi * ($x * $freq + $phase));
			//echo $amp . "<BR>";

			// The amplitude of the pixel (from 0 to 1)
			if ($env == "gaussian") {
				$f = exp(-0.5 * pow($x / $std, 2) - 0.5 * pow($y / $std, 2));
			} elseif ($env == "linear") {
				$f = max(0, (0.5 * $std * $size - $r) / (0.5 * $std * $size));
			} elseif ($env == "cos") {
				if ($r > $_size/2) {
					$f = 0;
				} else {
					$f = cos( (pi()*($r+$_size/2)) / ($_size-1) - pi()/2);
				}
			} elseif ($env == "hann") {
				if ($r > $_size/2) {
					$f = 0;
				} else {
					$f = 0.5*(1-cos( (2*pi()*($r+$_size/2)) / ($_size-1) ));
				}
			} elseif ($env == "hamming") {
				if ($r > $_size/2) {
					$f = 0;
				} else {
					$f = 0.54 - 0.46*cos( (2*pi()*($r+$_size/2)) / ($_size-1) );
				}
			} elseif ($env == "circle") {
				if ($r > 0.5 * $std * $size) {
					$f = 0;
				} else {
					$f = 1;
				}
			} else {
				$f = 1;
			}

			# Apply the envelope to the amplitude
			if ($bgmode == "average") {
				$amp = $amp * $f +  0.5 * (1 - $f);
			} else {
				$amp = $amp * $f;
			}

			$r = $r1 * $amp + $r2 * (1 - $amp);
			$g = $g1 * $amp + $g2 * (1 - $amp);
			$b = $b1 * $amp + $b2 * (1 - $amp);

			$col = imagecolorallocate($im, $r, $g, $b);
			imagesetpixel($im, $rx, $ry, $col);
		}
	}

	if ($filetype == "png") {
		imagepng($im, $outfile);
	} elseif ($filetype == "gif") {
		imagegif($im, $outfile);
	} elseif ($filetype == "jpg") {
		imagejpeg($im, $outfile);
	}

	imagedestroy($im);
}

function show_gabor($orient, $size, $std, $freq, $phase, $red1, $green1, $blue1, $red2, $green2, $blue2, $env, $bgmode)
{
	echo "<tr><td width=\"50%\" valign=\"top\">\n";

	$fname = sprintf("tmp/gabor-%s-%.2f-%d-%.2f-%.2f-%.2f-%d-%d-%d-%d-%d-%d.png", $env, $orient, $size, $std, $freq, $phase, $red1, $green1, $blue1, $red2, $green2, $blue2);
	generate_gabor($orient, $size, $env, $bgmode, $std, $freq, $phase, $red1, $green1, $blue1, $red2, $green2, $blue2, "png", $fname);


	echo "<img src=\"$fname\" /></td><td>\n";
	echo "Orientation: $orient<br />\n";
	echo "Size: $size<br />\n";
	echo "Envelope: $env<br />\n";
	if ($env == "gaussian") {
		echo "Standard deviation: $std<br />\n";
	}

	echo "Frequency: $freq<br />\n";
	echo "Phase: $phase<br />\n";
	echo "Color 1: $red1, $green1, $blue1<br />\n";
	echo "Color 2: $red2, $green2, $blue2<br />\n";
	echo "Background color: $bgmode<br />\n";

	echo "<a href=\"$fname\">Download</a>\n";

	echo "</td></tr>\n";

	return $fname;
}

$zipfile = "tmp/gabor-" . rand() . ".zip";

$zip = new ZipArchive();
if ($zip->open($zipfile, ZIPARCHIVE::CREATE)!==TRUE) {
    print "<p><b>Warning:</b> failed to create zip archive!</p>\n";
}

echo "<p align=\"center\"><a href=\"$zipfile\">Download all patches as a .zip file</a></p>\n";

echo "<table width=\"100%\" class=\"defaulttable\">\n";

foreach (explode(" ", $orient) as $_orient) {
	$_orient = floatval($_orient);
	foreach (explode(" ", $size) as $_size) {
		$_size = floatval($_size);
		foreach (explode(" ", $std) as $_std) {
			$_std = floatval($_std);
			foreach (explode(" ", $freq) as $_freq) {
				$_freq = floatval($_freq);
				foreach (explode(" ", $phase) as $_phase) {
					$_phase = floatval($_phase);
					$fname = show_gabor($_orient, $_size, $_std, $_freq, $_phase, $red1, $green1, $blue1, $red2, $green2, $blue2, $env, $bgmode);
					$zip->addFile($fname);
				}
			}
		}
	}
}

$zip->close();

echo "</table>\n";

?>

<p><i>Version 1.3</i></p>


