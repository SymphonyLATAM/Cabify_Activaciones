




// VERSION: 2.2 LAST UPDATE: 13.03.2012
/* 
 * Licensed under the MIT license: http://www.opensource.org/licenses/mit-license.php
 * 
 * Made by Wilq32, wilq32@gmail.com, Wroclaw, Poland, 01.2009
 * Website: http://code.google.com/p/jqueryrotate/ 
 */
(function(j){for(var d,k=document.getElementsByTagName("head")[0].style,h=["transformProperty","WebkitTransform","OTransform","msTransform","MozTransform"],g=0;g<h.length;g++)void 0!==k[h[g]]&&(d=h[g]);var i="v"=="\v";jQuery.fn.extend({rotate:function(a){if(!(0===this.length||"undefined"==typeof a)){"number"==typeof a&&(a={angle:a});for(var b=[],c=0,f=this.length;c<f;c++){var e=this.get(c);if(!e.Wilq32||!e.Wilq32.PhotoEffect){var d=j.extend(!0,{},a),e=(new Wilq32.PhotoEffect(e,d))._rootObj;
b.push(j(e))}else e.Wilq32.PhotoEffect._handleRotation(a)}return b}},getRotateAngle:function(){for(var a=[],b=0,c=this.length;b<c;b++){var f=this.get(b);f.Wilq32&&f.Wilq32.PhotoEffect&&(a[b]=f.Wilq32.PhotoEffect._angle)}return a},stopRotate:function(){for(var a=0,b=this.length;a<b;a++){var c=this.get(a);c.Wilq32&&c.Wilq32.PhotoEffect&&clearTimeout(c.Wilq32.PhotoEffect._timer)}}});Wilq32=window.Wilq32||{};Wilq32.PhotoEffect=function(){return d?function(a,b){a.Wilq32={PhotoEffect:this};this._img=this._rootObj=
this._eventObj=a;this._handleRotation(b)}:function(a,b){this._img=a;this._rootObj=document.createElement("span");this._rootObj.style.display="inline-block";this._rootObj.Wilq32={PhotoEffect:this};a.parentNode.insertBefore(this._rootObj,a);if(a.complete)this._Loader(b);else{var c=this;jQuery(this._img).bind("load",function(){c._Loader(b)})}}}();Wilq32.PhotoEffect.prototype={_setupParameters:function(a){this._parameters=this._parameters||{};"number"!==typeof this._angle&&(this._angle=0);"number"===
typeof a.angle&&(this._angle=a.angle);this._parameters.animateTo="number"===typeof a.animateTo?a.animateTo:this._angle;this._parameters.step=a.step||this._parameters.step||null;this._parameters.easing=a.easing||this._parameters.easing||function(a,c,f,e,d){return-e*((c=c/d-1)*c*c*c-1)+f};this._parameters.duration=a.duration||this._parameters.duration||1E3;this._parameters.callback=a.callback||this._parameters.callback||function(){};a.bind&&a.bind!=this._parameters.bind&&this._BindEvents(a.bind)},_handleRotation:function(a){this._setupParameters(a);
this._angle==this._parameters.animateTo?this._rotate(this._angle):this._animateStart()},_BindEvents:function(a){if(a&&this._eventObj){if(this._parameters.bind){var b=this._parameters.bind,c;for(c in b)b.hasOwnProperty(c)&&jQuery(this._eventObj).unbind(c,b[c])}this._parameters.bind=a;for(c in a)a.hasOwnProperty(c)&&jQuery(this._eventObj).bind(c,a[c])}},_Loader:function(){return i?function(a){var b=this._img.width,c=this._img.height;this._img.parentNode.removeChild(this._img);this._vimage=this.createVMLNode("image");
this._vimage.src=this._img.src;this._vimage.style.height=c+"px";this._vimage.style.width=b+"px";this._vimage.style.position="absolute";this._vimage.style.top="0px";this._vimage.style.left="0px";this._container=this.createVMLNode("group");this._container.style.width=b;this._container.style.height=c;this._container.style.position="absolute";this._container.setAttribute("coordsize",b-1+","+(c-1));this._container.appendChild(this._vimage);this._rootObj.appendChild(this._container);this._rootObj.style.position=
"relative";this._rootObj.style.width=b+"px";this._rootObj.style.height=c+"px";this._rootObj.setAttribute("id",this._img.getAttribute("id"));this._rootObj.className=this._img.className;this._eventObj=this._rootObj;this._handleRotation(a)}:function(a){this._rootObj.setAttribute("id",this._img.getAttribute("id"));this._rootObj.className=this._img.className;this._width=this._img.width;this._height=this._img.height;this._widthHalf=this._width/2;this._heightHalf=this._height/2;var b=Math.sqrt(this._height*
this._height+this._width*this._width);this._widthAdd=b-this._width;this._heightAdd=b-this._height;this._widthAddHalf=this._widthAdd/2;this._heightAddHalf=this._heightAdd/2;this._img.parentNode.removeChild(this._img);this._aspectW=(parseInt(this._img.style.width,10)||this._width)/this._img.width;this._aspectH=(parseInt(this._img.style.height,10)||this._height)/this._img.height;this._canvas=document.createElement("canvas");this._canvas.setAttribute("width",this._width);this._canvas.style.position="relative";
this._canvas.style.left=-this._widthAddHalf+"px";this._canvas.style.top=-this._heightAddHalf+"px";this._canvas.Wilq32=this._rootObj.Wilq32;this._rootObj.appendChild(this._canvas);this._rootObj.style.width=this._width+"px";this._rootObj.style.height=this._height+"px";this._eventObj=this._canvas;this._cnv=this._canvas.getContext("2d");this._handleRotation(a)}}(),_animateStart:function(){this._timer&&clearTimeout(this._timer);this._animateStartTime=+new Date;this._animateStartAngle=this._angle;this._animate()},
_animate:function(){var a=+new Date,b=a-this._animateStartTime>this._parameters.duration;if(b&&!this._parameters.animatedGif)clearTimeout(this._timer);else{(this._canvas||this._vimage||this._img)&&this._rotate(~~(10*this._parameters.easing(0,a-this._animateStartTime,this._animateStartAngle,this._parameters.animateTo-this._animateStartAngle,this._parameters.duration))/10);this._parameters.step&&this._parameters.step(this._angle);var c=this;this._timer=setTimeout(function(){c._animate.call(c)},10)}this._parameters.callback&&
b&&(this._angle=this._parameters.animateTo,this._rotate(this._angle),this._parameters.callback.call(this._rootObj))},_rotate:function(){var a=Math.PI/180;return i?function(a){this._angle=a;this._container.style.rotation=a%360+"deg"}:d?function(a){this._angle=a;this._img.style[d]="rotate("+a%360+"deg)"}:function(b){this._angle=b;b=b%360*a;this._canvas.width=this._width+this._widthAdd;this._canvas.height=this._height+this._heightAdd;this._cnv.translate(this._widthAddHalf,this._heightAddHalf);this._cnv.translate(this._widthHalf,
this._heightHalf);this._cnv.rotate(b);this._cnv.translate(-this._widthHalf,-this._heightHalf);this._cnv.scale(this._aspectW,this._aspectH);this._cnv.drawImage(this._img,0,0)}}()};i&&(Wilq32.PhotoEffect.prototype.createVMLNode=function(){document.createStyleSheet().addRule(".rvml","behavior:url(#default#VML)");try{return!document.namespaces.rvml&&document.namespaces.add("rvml","urn:schemas-microsoft-com:vml"),function(a){return document.createElement("<rvml:"+a+' class="rvml">')}}catch(a){return function(a){return document.createElement("<"+
a+' xmlns="urn:schemas-microsoft.com:vml" class="rvml">')}}}())})(jQuery);


jQuery(document).ready(function(){
   var deg_temp =45;
  jQuery("#image1").click(function(){
     deg_temp = deg_temp+30;
  jQuery(this).rotate(deg_temp);
  })

});
