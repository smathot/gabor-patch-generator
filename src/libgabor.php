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

function generate_gabor($orient, $size, $env, $std, $freq, $phase, $color0,
	$color1, $color2, $outfile)

	/**

	Generates and saves a Gabor patch.

	Arguments:

	$orient		--	The orientation of the patch in degrees.
	$size		--	The size of the patch in pixels.
	$env		--	The envelope, which is gaussian, linear, hann, hamming,
					circle, or rectangle.
	$std		--	The standard deviation of the envelope, in case it is
					gaussian.
	$freq		--	The spatial frequency of the patch.
	$phase		--	The phase of the patch.
	$color0		--	The background color as an RGB array.
	$color1		--	The first foreground color as an RGB array.
	$color2		--	The second foreground color as an RGB array.
	$outfile	--	The name for the output file.
	**/

{

	// Convert the orientation to radians
	$orient = deg2rad($orient);
	// Convert the size to a factor of the standard deviation
	$_size = $size;
	$size = $size / $std;
	$im = imagecreatetruecolor($_size, $_size) or
		die("Failed to create image");
	imagealphablending($im, false);
	imagesavealpha($im, true);
	for ($rx = 0; $rx < $std * $size; $rx++) {
		for ($ry = 0; $ry < $std * $size; $ry++) {
			// The dx from the center
			$dx = $rx - 0.5 * $std * $size;
			// The dy from the center
			$dy = $ry - 0.5 * $std * $size;
			// The angle of the pixel
			$t = atan2($dy, $dx) + $orient;
			// The distance of the pixel from the center
			$r = sqrt($dx * $dx + $dy * $dy);
			// The x coordinate in the unrotated image
			$x = $r * cos($t);
			// The y coordinate in the unrotated image
			$y = $r * sin($t);
			# The amplitude without envelope (from 0 to 1)
			$amp = 0.5 + 0.5 * cos(2 * pi() * ($x * $freq + $phase));
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
			$r = $color1[0] * $amp + $color2[0]*(1-$amp);
			$g = $color1[1] * $amp + $color2[1]*(1-$amp);
			$b = $color1[2] * $amp + $color2[2]*(1-$amp);

			if ($color0[0] < 0 or $color0[1] < 0 or $color0[2] < 0) {
				$color = imagecolorallocatealpha($im, $r, $g, $b, 127-127*$f);
			} else {
				$r = $r*$f + $color0[0]*(1-$f);
				$g = $g*$f + $color0[1]*(1-$f);
				$b = $b*$f + $color0[2]*(1-$f);
				$color = imagecolorallocatealpha($im, $r, $g, $b, 0);
			}
			imagesetpixel($im, $rx, $ry, $color);
		}
	}
	imagepng($im, $outfile);
	imagedestroy($im);
}

function show_gabor($orient, $size, $std, $freq, $phase, $color0, $color1,
	$color2, $env)

	/**
	Prints an HTML table row with a single Gabor in it.

	Arguments:
	See generate_gabor()
	**/

{
	echo "<tr><td width=\"50%\" valign=\"top\">\n";
	$fname = sprintf(
		"tmp/gabor-%s-%.2f-%d-%.2f-%.2f-%.2f-%s-%s-%s.png", $env,
		$orient, $size, $std, $freq, $phase, vsprintf('%s-%s-%s', $color0),
		vsprintf('%s-%s-%s', $color1), vsprintf('%s-%s-%s', $color2));
	generate_gabor($orient, $size, $env, $std, $freq, $phase, $color0,
		$color1, $color2, $fname);
	echo "<img src=\"$fname\" /></td><td>\n";
	echo "Orientation: $orient<br />\n";
	echo "Size: $size<br />\n";
	echo "Envelope: $env<br />\n";
	if ($env == "gaussian") {
		echo "Standard deviation: $std<br />\n";
	}
	echo "Frequency: $freq<br />\n";
	echo "Phase: $phase<br />\n";
	echo "Background color: " . vsprintf('%s, %s, %s', $color0) . "<br />\n";
	echo "Color 1: " . vsprintf('%s, %s, %s', $color1) . "<br />\n";
	echo "Color 2: " . vsprintf('%s, %s, %s', $color2) . "<br />\n";
	echo "<a href=\"$fname\">Download</a>\n";
	echo "</td></tr>\n";
	return $fname;
}

?>
