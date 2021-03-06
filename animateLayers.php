<h2>Animating layers</h2>

<p>jCanvas provides an <code>animateLayer()</code> method for animating the properties of a jCanvas layer.</p>

<p>The <code>animateLayer()</code> method accepts up to five arguments:</p>
<ol>
	<li>The <code>index</code> or <code>name</code> of the layer to be animated. The layer object itself is also an acceptable value.</li>
	<li>An object containing the properties to animate and their end values</li>
	<li>The duration of the animation in milliseconds (optional; defaults to <code>400</code>)</li>
	<li>The easing of the animation (optional; defaults to <code>"swing"</code>)</li>
	<li>A callback function that runs when the animation completes (optional)
		<ul>
			<li>Arguments
				<ul>
					<li>The percentage of the animation which has completed (as a value from <code>0</code> to <code>1</code>).</li>
					<li>A <code>jQuery.fx</code> object containing properties related to the animation.</li>
					<li>The layer being animated.</li>
				</ul>
			</li>
		</ul>
	</li>
</ol>

<pre class="prettyprint lang-js demo">
// Create and draw a rectangle layer
$("canvas").drawRect({
  layer: true,
  name: "myBox",
  fillStyle: "#36c",
  x: 50, y: 50,
  width: 0, height: 0
});

// Animate layer properties
$("canvas")
.animateLayer(0, {
  x: 150, y: 150,
  width: 100, height: 50
}, 1000, function(now, fx, layer) {
  // Callback function
  $(this).animateLayer("myBox", {
    fillStyle: "rgb(204, 51, 51)",
    x: 280, y: 100,
    rotate: 360
  }, "slow", "swing");
});
</pre>

<p>jCanvas can animate numeric values, as well as colors (hex, RGB, or color names). jCanvas also enables jQuery to utilize this color animation for HTML elements.</p>

<p>Additionally, you may use the string <code>"+="</code> or <code>"-="</code> to animate a property from the current value.</p>

<pre class="prettyprint lang-js">
$("canvas").animateLayer(0, {
  rotate: "+=360",
  x: "-=50"
});
</pre>

<h3>Functions as Property Values</h3>

<p>You can also use a callback function . Whatever the function returns will be used as the end-value to which that property will be animated.</p>

<p>As always, the value of <code>this</code> in your callback function is the canvas DOM element.</p>

<pre class="prettyprint lang-js">
$("canvas").animateLayer(0, {
  x: function(layer) {
    return Math.pow(params.x, 2);
  }
});
</pre>

<p>This capability is especially useful when using the below <code>animateLayerGroup()</code> method, in which you may not have direct access to each layer in the group. Now, such direct access to these layers is possible.</p>

<h3>Animating layer groups</h3>

<p>You can also animate all layers in a layer group using the <code>animateLayerGroup()</code> method.</p>

<p>The method accepts the same basic arguments as the <code>animateLayer()</code> method, </p>

<pre class='prettyprint lang-js demo'>
$("canvas")
// Draw a circle
.drawArc({
  layer: true,
  group: "circles",
  fillStyle: "#c33",
  x: 100, y: 100,
  radius: 50
})
// Draw another circle
.drawArc({
  layer: true,
  group: "circles",
  fillStyle: "#36c",
  x: 250, y: 100,
  radius: 50
})
// Animate all layers in the group "circles"
.animateLayerGroup('circles', {
  y: 200
}, 500);
</pre>

<h3>Stopping animation</h3>

<p>Similar to jQuery's <code>stop()</code> method, you can stop any layer animation in progress by calling the <code>stopLayer()</code> method.</p>

<pre class="prettyprint lang-js">
$("canvas").stopLayer(0);
</pre>

<p>Additionally, you may (optionally) pass in <code>true</code> as a second argument, which will also remove any queued animations.</p>

<pre class="prettyprint lang-js">
$("canvas").stopLayer("myBox", true);
</pre>

<p>You can also stop animation for all layers in a group using the <code>delayLayerGroup()</code> method</p>

<pre class="prettyprint lang-js">
$("canvas").stopLayerGroup("myGroup");
</pre>

<h3>Delaying animation</h3>

<p>Similar to jQuery's <code>delay()</code> method, you can delay any layer's animation queue by calling the <code>delayLayer()</code> method.</p>

<p>The method accepts two arguments: the layer name/index, and the number of milliseconds to delay animation.</p>

<pre class="prettyprint lang-js">
$("canvas").delayLayer("myBox", 500);
</pre>

<p>You can also delay animation for all layers in a group using the <code>delayLayerGroup()</code> method</p>

<pre class="prettyprint lang-js">
$("canvas").delayLayerGroup("myGroup", 500);
</pre>

<h3>Notes</h3>

<p>Multiple <code>animateLayer()</code> calls can be queued up rather than using multiple callback functions.</p>