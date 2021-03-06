<h2>Events</h2>

<p>jCanvas supports mouse and touch events for most drawings. Events are used in conjunction with the <a href='/projects/jcanvas/docs/layerAPI/'>Layers API</a>.</p>

<h3>Binding Events</h3>

<p>Any number of jCanvas events can be bound to any jCanvas layer.</p>

<p>The event property's name is always the name of the event itself (<code>click</code>, <code>mousedown</code>, <em>etc.</em>). These properties should be defined in the object passed to the <code>addLayer()</code> method.</p>

<p>The value of this event property must be a function. This callback function also accepts one argument, which is the layer's object of properties, as used below. Additionally, the <code>this</code> keyword refers to the canvas DOM element.</p>

<h3>Mouse events</h3>

<p>When you click the star in the demo below, it will spin.</p>

<pre class="prettyprint lang-js demo">
// Click the star to make it spin
$("canvas").drawPolygon({
  layer: true,
  fillStyle: "#c33",
  x: 100, y: 100,
  radius: 50,
  sides: 5,
  projection: -0.5,
  click: function(layer) {
    // Spin star
    $(this).animateLayer(layer, {
      rotate: '+=144'
    });
  }
});
</pre>

<h3>Multiple layers with events</h3>

<p>This example utilizes multiple layers with events attached.</p>

<p>When calling the <code>animateLayer()</code> method, you should pass it the layer object to animate that particular layer. Failing to do so will animate the first layer by default.</p>

<pre class="prettyprint lang-js demo">
// Create five cascading stars
for (var i=0; i&lt;5; i+=1) {

  $("canvas").drawPolygon({
    layer: true,
    fillStyle: "#c33",
    x: 50+(i*60), y: 50+(i*60),
    radius: 30,
    sides: 5,
    projection: -0.5,
    click: function(layer) {
      // Click a star to spin it
      $(this).animateLayer(layer, {
        rotate: '+=144'
      });
    }
  });

}
</pre>

<h3>The <code>mouseover</code> and <code>mouseout</code> events</h3>

<p>The <code>mouseover</code> and <code>mouseout</code> can be used separately, or together.</p>

<pre class='prettyprint lang-js demo'>
// Hover over the triangle to rotate it
$("canvas").drawPolygon({
  layer: true,
  fillStyle: "#c33",
  strokeStyle: "#333",
  strokeWidth: 2,
  x: 180, y: 150,
  radius: 100,
  sides: 3,
  mouseover: function(layer) {
    $(this).animateLayer(layer, {
      rotate: "+=60"
    }, 500);
  },
  mouseout: function(layer) {
    $(this).animateLayer(layer, {
      rotate: "+=60"
    }, 500);
  },
});
</pre>

<h3>The <code>eventX</code> and <code>eventY</code> properties</h3>

<p>In the event callback, you have access to the layer's <code>eventX</code> and <code>eventY</code> properties. These are the coordinates of the mouse when the event fired.</p>

<p>In this example, the closer you hover to the circle's center, the more transparent it will become.</p>

<pre class='prettyprint lang-js demo'>
$("canvas").drawArc({
  layer: true,
  fillStyle: "#c33",
  x: 180, y: 200,
  radius: 100,
  mousemove: function(layer) {
    var dx, dy, dist;
    dx = layer.eventX - layer.x;
    dy = layer.eventY - layer.y;
    dist = Math.sqrt(Math.pow(dx, 2) + Math.pow(dy, 2));
    layer.opacity = dist / layer.radius;
  }
});
</pre>

<h3>The <code>cursor</code> property</h3>

<p>In this example, the <code>cursor</code> property is used to display a pointer cursor when hovering over the layer.</p>

<pre class='prettyprint lang-js demo'>
// Create a clickable link
$("canvas").drawText({
  layer: true,
  fillStyle: "#9cf",
  strokeStyle: "#000",
  strokeWidth: 2,
  x: 180, y: 100,
  text: "Click here",
  fontFamily: "Trebuchet MS",
  fontSize: 64,
  // Show pointer cursor on hover
  cursor: "pointer",
  // Click link to open it
  click: function(layer) {
    window.open("http://www.google.com/");
  }
});
</pre>

<h3>Drag-and-drop</h3>

<p>Layers can also be made draggable using the <code>draggable</code> property.</p>

<p>Please note that only layers can be made draggable (that is, the layer property must be set to <code>true</code>).</p>

<pre class='prettyprint lang-js demo'>
$("canvas")
.drawArc({
  layer: true,
  draggable: true,
  fillStyle: "#36b",
  x: 150, y: 150,
  radius: 50
})
.drawRect({
  layer: true,
  draggable: true,
  fillStyle: "#6c1",
  x: 100, y: 100,
  width: 100, height: 100
});
</pre>

<p>By default, draggable shapes will <strong>not</strong> move to the front when clicked. To change this behavior, set the <code>bringToFront</code> property to <code>true</code>.</p>

<pre class='prettyprint lang-js demo'>
$("canvas")
.drawArc({
  layer: true,
  draggable: true,
  bringToFront: true,
  fillStyle: "#36b",
  x: 150, y: 150,
  radius: 50
})
.drawRect({
  layer: true,
  draggable: true,
  bringToFront: true,
  fillStyle: "#6c1",
  x: 100, y: 100,
  width: 100, height: 100
});
</pre>

<p>You can provide callbacks for when any drag event occurs by defining <code>dragstart</code>, <code>drag</code>, <code>dragstop</code>, and <code>dragcancel</code> callbacks.</p>

<div class='column'>
<h3>Supported Methods</h3>
<ul>
	<li><code>drawRect()</code></li>
	<li><code>drawArc()</code></li>
	<li><code>drawEllipse()</code></li>
	<li><code>drawLine()</code></li>
	<li><code>drawQuadratic()</code></li>
	<li><code>drawBezier()</code></li>
	<li><code>drawVector()</code></li>
	<li><code>drawGraph()</code></li>
	<li><code>drawPolygon()</code></li>
	<li><code>drawImage()</code></li>
	<li><code>drawText()</code></li>
</ul>
</div>

<div class='column'>
<h3>Supported Events</h3>
<ul>
	<li><code>click</code></li>
	<li><code>dblclick</code></li>
	<li><code>mousedown</code></li>
	<li><code>mouseup</code></li>
	<li><code>mousemove</code></li>
	<li><code>mouseover</code></li>
	<li><code>mouseout</code></li>
	<li><code>dragstart</code></li>
	<li><code>drag</code></li>
	<li><code>dragstop</code></li>
	<li><code>touchstart</code></li>
	<li><code>touchend</code></li>
	<li><code>touchmove</code></li>
</ul>
</div>

<div class='clearfix'></div>

<h3>Draggable groups</h3>

<p>jCanvas allows you to assign a drag group to a layer. This means that when the layer is dragged, all other layers in the same layer <code>group</code> will also be dragged.</p>

<p>This draggable grouping is achieved when you add the <code>dragGroupWithLayer</code> property to any (typically all) layers in the same ayer group.</p>

<pre class='prettyprint lang-js demo'>
// Both layers will be dragged together
$("canvas")
.drawArc({
  layer: true,
  draggable: true,
  group: 'shapes',
  dragGroupWithLayer: true,
  fillStyle: "#36b",
  x: 150, y: 150,
  radius: 50
})
.drawRect({
  layer: true,
  draggable: true,
  group: 'shapes',
  dragGroupWithLayer: true,
  fillStyle: "#6c1",
  x: 100, y: 100,
  width: 100, height: 100
});
</pre>

<h3>Touch Events</h3>

<p>jCanvas also supports native touch events on iOS and Android using the <code>touchstart</code>, <code>touchend</code>, and <code>touchmove</code> events.</p>

<pre class='prettyprint lang-js demo'>
// This demo will only work on iOS and Android
$("canvas").drawRect({
  layer: true,
  fillStyle: "#36c",
  x: 150, y: 100,
  width: 120, height: 80,
  touchstart: function(layer) {
    // Animate layer when touched
    $(this).animateLayer(0, {
      fillStyle: "#c33",
      scale: 1.5
    });
  },
  touchend: function(layer) {
    // Revert layer when touch ends
    $(this).animateLayer(0, {
      fillStyle: "#36c",
      scale: 1
    });
  }
});
</pre>

<p>As a bonus, jCanvas will also convert existing <code>mousedown</code>, <code>mouseup</code>, and <code>mousemove</code> callbacks to their respective touch events on iOS and Android. In other words, jCanvas code that you've written for desktop browsers will be automatically optimized for mobile browsers on iOS and Android.</p>

<pre class='prettyprint lang-js demo'>
// This demo will work on iOS, Android, and desktop browsers
$("canvas").drawRect({
  layer: true,
  fillStyle: "#36c",
  x: 150, y: 100,
  width: 120, height: 80,
  mousedown: function(layer) {
    // Animate layer when moused on or touched
    $(this).animateLayer(0, {
      fillStyle: "#c33",
      scale: 1.5
    });
  },
  mouseup: function(layer) {
    // Animate layer when moused off or touch ends
    $(this).animateLayer(0, {
      fillStyle: "#36c",
      scale: 1
    });
  }
});
</pre>

<p>At this time, jCanvas does not support multi-touch.</p>

<h3 class='clearfix'>Notes</h3>

<p>Events only can be bound when creating a jCanvas layer, and cannot be bound to shapes drawn using regular jCanvas methods (<code>drawRect()</code>, <code>drawArc()</code>, etc.).</p>

<p>Events cannot be bound to function layers (created with the <code>draw()</code> method).</p>