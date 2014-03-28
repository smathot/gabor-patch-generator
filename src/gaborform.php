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

?>

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
<small>Determines the shape of the patch.<br />
See <a href="http://en.wikipedia.org/wiki/Window_function" target="_blank">
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
Background color<br />
<small>RGB values should be in the 0-255 range or negative (-1).<br />
Negative values create a transparent background.
</td><td>
Red: <input type="text" name="red0" value="<?php echo  $red0 ?>" size=3>
Green: <input type="text" name="green0" value="<?php echo  $green0 ?>" size=3>
Blue: <input type="text" name="blue0" value="<?php echo  $blue0 ?>" size=3>
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

<tr><td colspan=2 align="center">
<input type="submit" value="Generate!">
</td></tr>

</table>

</form>

