// Rivets.js
// version: 0.8.0
// author: Michael Richards
// license: MIT

define("sp/modalHelper",["jquery","sp/global"],function(t,e){"use strict";var i=function(e){t(e).trigger("reset")},n=function(t){t.reset()};return{setupFocus:function(i,n){t(i).on("shown.bs.modal",function(){t(this).find(":tabbable").first().focus()}),t(i).on("hidden.bs.modal",function(){e.resetOnErrorDocumentTitle(),t(n).focus()})},disableButtonOnClick:function(e){e=e?e:2e3,t(".sp-preloading").on("click",function(){t(this).addClass("disabled btn-loading").delay(e).queue(function(){t(this).removeClass("disabled btn-loading").dequeue()})})},unsetLoadingStatus:function(){t(".sp-preloading").removeClass("disabled btn-loading")},cleanFormOnHideModal:function(e,r,s){t(r).on("hide.bs.modal",function(){i(s),n(e)})},closeModal:function(e){t(e).modal("hide")}}}),function(){function t(t,i,n,r){return new e(t,i,n,r)}function e(t,e,n,r){this.options=r||{},this.options.adapters=this.options.adapters||{},this.obj=t,this.keypath=e,this.callback=n,this.objectPath=[],this.parse(),i(this.target=this.realize())&&this.set(!0,this.key,this.target,this.callback)}function i(t){return"object"==typeof t&&null!==t}function n(t){throw new Error("[sightglass] "+t)}t.adapters={},e.tokenize=function(t,e,i){var n,r,s=[],o={i:i,path:""};for(n=0;n<t.length;n++)r=t.charAt(n),~e.indexOf(r)?(s.push(o),o={i:r,path:""}):o.path+=r;return s.push(o),s},e.prototype.parse=function(){var i,r,s=this.interfaces();s.length||n("Must define at least one adapter interface."),~s.indexOf(this.keypath[0])?(i=this.keypath[0],r=this.keypath.substr(1)):("undefined"==typeof(i=this.options.root||t.root)&&n("Must define a default root adapter."),r=this.keypath),this.tokens=e.tokenize(r,s,i),this.key=this.tokens.pop()},e.prototype.realize=function(){var t,e=this.obj,n=!1;return this.tokens.forEach(function(r,s){i(e)?("undefined"!=typeof this.objectPath[s]?e!==(t=this.objectPath[s])&&(this.set(!1,r,t,this.update.bind(this)),this.set(!0,r,e,this.update.bind(this)),this.objectPath[s]=e):(this.set(!0,r,e,this.update.bind(this)),this.objectPath[s]=e),e=this.get(r,e)):(n===!1&&(n=s),(t=this.objectPath[s])&&this.set(!1,r,t,this.update.bind(this)))},this),n!==!1&&this.objectPath.splice(n),e},e.prototype.update=function(){var t,e;(t=this.realize())!==this.target&&(i(this.target)&&this.set(!1,this.key,this.target,this.callback),i(t)&&this.set(!0,this.key,t,this.callback),e=this.value(),this.target=t,this.value()!==e&&this.callback())},e.prototype.value=function(){if(i(this.target))return this.get(this.key,this.target)},e.prototype.setValue=function(t){i(this.target)&&this.adapter(this.key).set(this.target,this.key.path,t)},e.prototype.get=function(t,e){return this.adapter(t).get(e,t.path)},e.prototype.set=function(t,e,i,n){var r=t?"observe":"unobserve";this.adapter(e)[r](i,e.path,n)},e.prototype.interfaces=function(){var e=Object.keys(this.options.adapters);return Object.keys(t.adapters).forEach(function(t){~e.indexOf(t)||e.push(t)}),e},e.prototype.adapter=function(e){return this.options.adapters[e.i]||t.adapters[e.i]},e.prototype.unobserve=function(){var t;this.tokens.forEach(function(e,i){(t=this.objectPath[i])&&this.set(!1,e,t,this.update.bind(this))},this),i(this.target)&&this.set(!1,this.key,this.target,this.callback)},"undefined"!=typeof module&&module.exports?module.exports=t:"function"==typeof define&&define.amd?define("sightglass",[],function(){return this.sightglass=t}):this.sightglass=t}.call(this),function(){var t,e,i,n,r=function(t,e){return function(){return t.apply(e,arguments)}},s=[].slice,o={}.hasOwnProperty,a=function(t,e){function i(){this.constructor=t}for(var n in e)o.call(e,n)&&(t[n]=e[n]);return i.prototype=e.prototype,t.prototype=new i,t.__super__=e.prototype,t},l=[].indexOf||function(t){for(var e=0,i=this.length;i>e;e++)if(e in this&&this[e]===t)return e;return-1};t={options:["prefix","templateDelimiters","rootInterface","preloadData","handler"],extensions:["binders","formatters","components","adapters"],public:{binders:{},components:{},formatters:{},adapters:{},prefix:"rv",templateDelimiters:["{","}"],rootInterface:".",preloadData:!0,handler:function(t,e,i){return this.call(t,e,i.view.models)},configure:function(e){var i,n,r,s;null==e&&(e={});for(r in e)if(s=e[r],"binders"===r||"components"===r||"formatters"===r||"adapters"===r)for(n in s)i=s[n],t[r][n]=i;else t.public[r]=s},bind:function(e,i,n){var r;return null==i&&(i={}),null==n&&(n={}),r=new t.View(e,i,n),r.bind(),r},init:function(e,i,n){var r,s;return null==n&&(n={}),null==i&&(i=document.createElement("div")),e=t.public.components[e],i.innerHTML=e.template.call(this,i),r=e.initialize.call(this,i,n),s=new t.View(i,r),s.bind(),s}}},window.jQuery||window.$?(n="on"in jQuery.prototype?["on","off"]:["bind","unbind"],e=n[0],i=n[1],t.Util={bindEvent:function(t,i,n){return jQuery(t)[e](i,n)},unbindEvent:function(t,e,n){return jQuery(t)[i](e,n)},getInputValue:function(t){var e;return e=jQuery(t),"checkbox"===e.attr("type")?e.is(":checked"):e.val()}}):t.Util={bindEvent:function(){return"addEventListener"in window?function(t,e,i){return t.addEventListener(e,i,!1)}:function(t,e,i){return t.attachEvent("on"+e,i)}}(),unbindEvent:function(){return"removeEventListener"in window?function(t,e,i){return t.removeEventListener(e,i,!1)}:function(t,e,i){return t.detachEvent("on"+e,i)}}(),getInputValue:function(t){var e,i,n,r;if("checkbox"===t.type)return t.checked;if("select-multiple"===t.type){for(r=[],i=0,n=t.length;n>i;i++)e=t[i],e.selected&&r.push(e.value);return r}return t.value}},t.TypeParser=function(){function t(){}return t.types={primitive:0,keypath:1},t.parse=function(t){return/^'.*'$|^".*"$/.test(t)?{type:this.types.primitive,value:t.slice(1,-1)}:"true"===t?{type:this.types.primitive,value:!0}:"false"===t?{type:this.types.primitive,value:!1}:"null"===t?{type:this.types.primitive,value:null}:"undefined"===t?{type:this.types.primitive,value:void 0}:isNaN(Number(t))===!1?{type:this.types.primitive,value:Number(t)}:{type:this.types.keypath,value:t}},t}(),t.TextTemplateParser=function(){function t(){}return t.types={text:0,binding:1},t.parse=function(t,e){var i,n,r,s,o,a,l;for(a=[],s=t.length,i=0,n=0;s>n;){if(i=t.indexOf(e[0],n),0>i){a.push({type:this.types.text,value:t.slice(n)});break}if(i>0&&i>n&&a.push({type:this.types.text,value:t.slice(n,i)}),n=i+e[0].length,i=t.indexOf(e[1],n),0>i){o=t.slice(n-e[1].length),r=a[a.length-1],(null!=r?r.type:void 0)===this.types.text?r.value+=o:a.push({type:this.types.text,value:o});break}l=t.slice(n,i).trim(),a.push({type:this.types.binding,value:l}),n=i+e[1].length}return a},t}(),t.View=function(){function e(e,i,n){var s,o,a,l,u,h,d,p,c,f,b,v,y;for(this.els=e,this.models=i,null==n&&(n={}),this.update=r(this.update,this),this.publish=r(this.publish,this),this.sync=r(this.sync,this),this.unbind=r(this.unbind,this),this.bind=r(this.bind,this),this.select=r(this.select,this),this.traverse=r(this.traverse,this),this.build=r(this.build,this),this.buildBinding=r(this.buildBinding,this),this.bindingRegExp=r(this.bindingRegExp,this),this.options=r(this.options,this),this.els.jquery||this.els instanceof Array||(this.els=[this.els]),c=t.extensions,u=0,d=c.length;d>u;u++){if(o=c[u],this[o]={},n[o]){f=n[o];for(s in f)a=f[s],this[o][s]=a}b=t.public[o];for(s in b)a=b[s],null==(l=this[o])[s]&&(l[s]=a)}for(v=t.options,h=0,p=v.length;p>h;h++)o=v[h],this[o]=null!=(y=n[o])?y:t.public[o];this.build()}return e.prototype.options=function(){var e,i,n,r,s;for(i={},s=t.extensions.concat(t.options),n=0,r=s.length;r>n;n++)e=s[n],i[e]=this[e];return i},e.prototype.bindingRegExp=function(){return new RegExp("^"+this.prefix+"-")},e.prototype.buildBinding=function(e,i,n,r){var s,o,a,l,u,h,d;return u={},d=function(){var t,e,i,n;for(i=r.split("|"),n=[],t=0,e=i.length;e>t;t++)h=i[t],n.push(h.trim());return n}(),s=function(){var t,e,i,n;for(i=d.shift().split("<"),n=[],t=0,e=i.length;e>t;t++)o=i[t],n.push(o.trim());return n}(),l=s.shift(),u.formatters=d,(a=s.shift())&&(u.dependencies=a.split(/\s+/)),this.bindings.push(new t[e](this,i,n,l,u))},e.prototype.build=function(){var e,i,n,r,s;for(this.bindings=[],i=function(e){return function(n){var r,s,o,a,l,u,h,d,p,c,f,b,v,y;if(3===n.nodeType){if(l=t.TextTemplateParser,(o=e.templateDelimiters)&&(d=l.parse(n.data,o)).length&&(1!==d.length||d[0].type!==l.types.text)){for(p=0,f=d.length;f>p;p++)h=d[p],u=document.createTextNode(h.value),n.parentNode.insertBefore(u,n),1===h.type&&e.buildBinding("TextBinding",u,null,h.value);n.parentNode.removeChild(n)}}else 1===n.nodeType&&(r=e.traverse(n));if(!r){for(v=function(){var t,e,i,r;for(i=n.childNodes,r=[],t=0,e=i.length;e>t;t++)a=i[t],r.push(a);return r}(),y=[],c=0,b=v.length;b>c;c++)s=v[c],y.push(i(s));return y}}}(this),s=this.els,n=0,r=s.length;r>n;n++)e=s[n],i(e);this.bindings.sort(function(t,e){var i,n;return((null!=(i=e.binder)?i.priority:void 0)||0)-((null!=(n=t.binder)?n.priority:void 0)||0)})},e.prototype.traverse=function(e){var i,n,r,s,o,a,l,u,h,d,p,c,f,b,v,y;for(s=this.bindingRegExp(),o="SCRIPT"===e.nodeName||"STYLE"===e.nodeName,b=e.attributes,d=0,c=b.length;c>d;d++)if(i=b[d],s.test(i.name)){if(u=i.name.replace(s,""),!(r=this.binders[u])){v=this.binders;for(a in v)h=v[a],"*"!==a&&-1!==a.indexOf("*")&&(l=new RegExp("^"+a.replace(/\*/g,".+")+"$"),l.test(u)&&(r=h))}r||(r=this.binders["*"]),r.block&&(o=!0,n=[i])}for(y=n||e.attributes,p=0,f=y.length;f>p;p++)i=y[p],s.test(i.name)&&(u=i.name.replace(s,""),this.buildBinding("Binding",e,u,i.value));return o||(u=e.nodeName.toLowerCase(),this.components[u]&&!e._bound&&(this.bindings.push(new t.ComponentBinding(this,e,u)),o=!0)),o},e.prototype.select=function(t){var e,i,n,r,s;for(r=this.bindings,s=[],i=0,n=r.length;n>i;i++)e=r[i],t(e)&&s.push(e);return s},e.prototype.bind=function(){var t,e,i,n,r;for(n=this.bindings,r=[],e=0,i=n.length;i>e;e++)t=n[e],r.push(t.bind());return r},e.prototype.unbind=function(){var t,e,i,n,r;for(n=this.bindings,r=[],e=0,i=n.length;i>e;e++)t=n[e],r.push(t.unbind());return r},e.prototype.sync=function(){var t,e,i,n,r;for(n=this.bindings,r=[],e=0,i=n.length;i>e;e++)t=n[e],r.push(t.sync());return r},e.prototype.publish=function(){var t,e,i,n,r;for(n=this.select(function(t){return t.binder.publishes}),r=[],e=0,i=n.length;i>e;e++)t=n[e],r.push(t.publish());return r},e.prototype.update=function(t){var e,i,n,r,s,o,a;null==t&&(t={});for(i in t)n=t[i],this.models[i]=n;for(o=this.bindings,a=[],r=0,s=o.length;s>r;r++)e=o[r],a.push(e.update(t));return a},e}(),t.Binding=function(){function e(t,e,i,n,s){this.view=t,this.el=e,this.type=i,this.keypath=n,this.options=null!=s?s:{},this.getValue=r(this.getValue,this),this.update=r(this.update,this),this.unbind=r(this.unbind,this),this.bind=r(this.bind,this),this.publish=r(this.publish,this),this.sync=r(this.sync,this),this.set=r(this.set,this),this.eventHandler=r(this.eventHandler,this),this.formattedValue=r(this.formattedValue,this),this.parseTarget=r(this.parseTarget,this),this.observe=r(this.observe,this),this.setBinder=r(this.setBinder,this),this.formatters=this.options.formatters||[],this.dependencies=[],this.formatterObservers={},this.model=void 0,this.setBinder()}return e.prototype.setBinder=function(){var t,e,i,n;if(!(this.binder=this.view.binders[this.type])){n=this.view.binders;for(t in n)i=n[t],"*"!==t&&-1!==t.indexOf("*")&&(e=new RegExp("^"+t.replace(/\*/g,".+")+"$"),e.test(this.type)&&(this.binder=i,this.args=new RegExp("^"+t.replace(/\*/g,"(.+)")+"$").exec(this.type),this.args.shift()))}return this.binder||(this.binder=this.view.binders["*"]),this.binder instanceof Function?this.binder={routine:this.binder}:void 0},e.prototype.observe=function(e,i,n){return t.sightglass(e,i,n,{root:this.view.rootInterface,adapters:this.view.adapters})},e.prototype.parseTarget=function(){var e;return e=t.TypeParser.parse(this.keypath),0===e.type?this.value=e.value:(this.observer=this.observe(this.view.models,this.keypath,this.sync),this.model=this.observer.target)},e.prototype.formattedValue=function(e){var i,n,r,o,a,l,u,h,d,p,c,f,b,v;for(v=this.formatters,o=p=0,f=v.length;f>p;o=++p){for(a=v[o],r=a.match(/[^\s']+|'([^']|'[^\s])*'|"([^"]|"[^\s])*"/g),l=r.shift(),a=this.view.formatters[l],r=function(){var e,i,s;for(s=[],e=0,i=r.length;i>e;e++)n=r[e],s.push(t.TypeParser.parse(n));return s}(),h=[],i=c=0,b=r.length;b>c;i=++c)n=r[i],h.push(0===n.type?n.value:((d=this.formatterObservers)[o]||(d[o]={}),(u=this.formatterObservers[o][i])?void 0:(u=this.observe(this.view.models,n.value,this.sync),this.formatterObservers[o][i]=u),u.value()));(null!=a?a.read:void 0)instanceof Function?e=a.read.apply(a,[e].concat(s.call(h))):a instanceof Function&&(e=a.apply(null,[e].concat(s.call(h))))}return e},e.prototype.eventHandler=function(t){var e,i;return i=(e=this).view.handler,function(n){return i.call(t,this,n,e)}},e.prototype.set=function(t){var e;return t=t instanceof Function&&!this.binder.function?this.formattedValue(t.call(this.model)):this.formattedValue(t),null!=(e=this.binder.routine)?e.call(this,this.el,t):void 0},e.prototype.sync=function(){var t,e;return this.set(function(){var i,n,r,s,o,a,l;if(this.observer){if(this.model!==this.observer.target){for(o=this.dependencies,i=0,r=o.length;r>i;i++)e=o[i],e.unobserve();if(this.dependencies=[],null!=(this.model=this.observer.target)&&(null!=(a=this.options.dependencies)?a.length:void 0))for(l=this.options.dependencies,n=0,s=l.length;s>n;n++)t=l[n],e=this.observe(this.model,t,this.sync),this.dependencies.push(e)}return this.observer.value()}return this.value}.call(this))},e.prototype.publish=function(){var t,e,i,n,r,o,a,l,u;if(this.observer){for(n=this.getValue(this.el),a=this.formatters.slice(0).reverse(),r=0,o=a.length;o>r;r++)e=a[r],t=e.split(/\s+/),i=t.shift(),(null!=(l=this.view.formatters[i])?l.publish:void 0)&&(n=(u=this.view.formatters[i]).publish.apply(u,[n].concat(s.call(t))));return this.observer.setValue(n)}},e.prototype.bind=function(){var t,e,i,n,r,s,o;if(this.parseTarget(),null!=(r=this.binder.bind)&&r.call(this,this.el),null!=this.model&&(null!=(s=this.options.dependencies)?s.length:void 0))for(o=this.options.dependencies,i=0,n=o.length;n>i;i++)t=o[i],e=this.observe(this.model,t,this.sync),this.dependencies.push(e);return this.view.preloadData?this.sync():void 0},e.prototype.unbind=function(){var t,e,i,n,r,s,o,a,l,u;for(null!=(o=this.binder.unbind)&&o.call(this,this.el),null!=(a=this.observer)&&a.unobserve(),l=this.dependencies,r=0,s=l.length;s>r;r++)n=l[r],n.unobserve();this.dependencies=[],u=this.formatterObservers;for(i in u){e=u[i];for(t in e)n=e[t],n.unobserve()}return this.formatterObservers={}},e.prototype.update=function(t){var e,i;return null==t&&(t={}),this.model=null!=(e=this.observer)?e.target:void 0,null!=(i=this.binder.update)?i.call(this,t):void 0},e.prototype.getValue=function(e){return this.binder&&null!=this.binder.getValue?this.binder.getValue.call(this,e):t.Util.getInputValue(e)},e}(),t.ComponentBinding=function(e){function i(t,e,i){var n,s,o,a,u,h,d;for(this.view=t,this.el=e,this.type=i,this.unbind=r(this.unbind,this),this.bind=r(this.bind,this),this.locals=r(this.locals,this),this.component=this.view.components[this.type],this.static={},this.observers={},this.upstreamObservers={},s=t.bindingRegExp(),h=this.el.attributes||[],a=0,u=h.length;u>a;a++)n=h[a],s.test(n.name)||(o=this.camelCase(n.name),l.call(null!=(d=this.component.static)?d:[],o)>=0?this.static[o]=n.value:this.observers[o]=n.value)}return a(i,e),i.prototype.sync=function(){},i.prototype.locals=function(){var t,e,i,n,r,s;i={},r=this.static;for(t in r)n=r[t],i[t]=n;s=this.observers;for(t in s)e=s[t],i[t]=e.value();return i},i.prototype.camelCase=function(t){return t.replace(/-([a-z])/g,function(t){return t[1].toUpperCase()})},i.prototype.bind=function(){var e,i,n,r,s,o,a,l,u,h,d,p,c,f,b,v,y,m,g,w,k;if(!this.bound){f=this.observers;for(i in f)n=f[i],this.observers[i]=this.observe(this.view.models,n,function(t){return function(){return t.componentView.models[i]=t.observers[i].value()}}(this));this.bound=!0}if(null!=this.componentView)return this.componentView.bind();for(this.el.innerHTML=this.component.template.call(this),a=this.component.initialize.call(this,this.el,this.locals()),this.el._bound=!0,o={},b=t.extensions,h=0,p=b.length;p>h;h++){if(s=b[h],o[s]={},this.component[s]){v=this.component[s];for(e in v)l=v[e],o[s][e]=l}y=this.view[s];for(e in y)l=y[e],null==(u=o[s])[e]&&(u[e]=l)}for(m=t.options,d=0,c=m.length;c>d;d++)s=m[d],o[s]=null!=(g=this.component[s])?g:this.view[s];this.componentView=new t.View(this.el,a,o),this.componentView.bind(),w=this.observers,k=[];for(i in w)r=w[i],k.push(this.upstreamObservers[i]=this.observe(this.componentView.models,i,function(t){return function(){return r.setValue(t.componentView.models[i])}}(this)));return k},i.prototype.unbind=function(){var t,e,i,n,r;i=this.upstreamObservers;for(t in i)e=i[t],e.unobserve();n=this.observers;for(t in n)e=n[t],e.unobserve();return null!=(r=this.componentView)?r.unbind.call(this):void 0},i}(t.Binding),t.TextBinding=function(t){function e(t,e,i,n,s){this.view=t,this.el=e,this.type=i,this.keypath=n,this.options=null!=s?s:{},this.sync=r(this.sync,this),this.formatters=this.options.formatters||[],this.dependencies=[],this.formatterObservers={}}return a(e,t),e.prototype.binder={routine:function(t,e){return t.data=null!=e?e:""}},e.prototype.sync=function(){return e.__super__.sync.apply(this,arguments)},e}(t.Binding),t.public.binders.text=function(t,e){return null!=t.textContent?t.textContent=null!=e?e:"":t.innerText=null!=e?e:""},t.public.binders.html=function(t,e){return t.innerHTML=null!=e?e:""},t.public.binders.show=function(t,e){return t.style.display=e?"":"none"},t.public.binders.hide=function(t,e){return t.style.display=e?"none":""},t.public.binders.enabled=function(t,e){return t.disabled=!e},t.public.binders.disabled=function(t,e){return t.disabled=!!e},t.public.binders.checked={publishes:!0,priority:2e3,bind:function(e){return t.Util.bindEvent(e,"change",this.publish)},unbind:function(e){return t.Util.unbindEvent(e,"change",this.publish)},routine:function(t,e){var i;return t.checked="radio"===t.type?(null!=(i=t.value)?i.toString():void 0)===(null!=e?e.toString():void 0):!!e}},t.public.binders.unchecked={publishes:!0,priority:2e3,bind:function(e){return t.Util.bindEvent(e,"change",this.publish)},unbind:function(e){return t.Util.unbindEvent(e,"change",this.publish)},routine:function(t,e){var i;return t.checked="radio"===t.type?(null!=(i=t.value)?i.toString():void 0)!==(null!=e?e.toString():void 0):!e}},t.public.binders.value={publishes:!0,priority:3e3,bind:function(e){return"INPUT"!==e.tagName||"radio"!==e.type?(this.event="SELECT"===e.tagName?"change":"input",t.Util.bindEvent(e,this.event,this.publish)):void 0},unbind:function(e){return"INPUT"!==e.tagName||"radio"!==e.type?t.Util.unbindEvent(e,this.event,this.publish):void 0},routine:function(t,e){var i,n,r,s,o,a,u;if("INPUT"===t.tagName&&"radio"===t.type)return t.setAttribute("value",e);if(null!=window.jQuery){if(t=jQuery(t),(null!=e?e.toString():void 0)!==(null!=(s=t.val())?s.toString():void 0))return t.val(null!=e?e:"")}else if("select-multiple"===t.type){if(null!=e){for(u=[],n=0,r=t.length;r>n;n++)i=t[n],u.push(i.selected=(o=i.value,l.call(e,o)>=0));return u}}else if((null!=e?e.toString():void 0)!==(null!=(a=t.value)?a.toString():void 0))return t.value=null!=e?e:""}},t.public.binders.if={block:!0,priority:4e3,bind:function(t){var e,i;return null==this.marker?(e=[this.view.prefix,this.type].join("-").replace("--","-"),i=t.getAttribute(e),this.marker=document.createComment(" rivets: "+this.type+" "+i+" "),this.bound=!1,t.removeAttribute(e),t.parentNode.insertBefore(this.marker,t),t.parentNode.removeChild(t)):void 0},unbind:function(){var t;return null!=(t=this.nested)?t.unbind():void 0},routine:function(e,i){var n,r,s,o;if(!!i==!this.bound){if(i){s={},o=this.view.models;for(n in o)r=o[n],s[n]=r;return(this.nested||(this.nested=new t.View(e,s,this.view.options()))).bind(),this.marker.parentNode.insertBefore(e,this.marker.nextSibling),this.bound=!0}return e.parentNode.removeChild(e),this.nested.unbind(),this.bound=!1}},update:function(t){var e;return null!=(e=this.nested)?e.update(t):void 0}},t.public.binders.unless={block:!0,priority:4e3,bind:function(e){return t.public.binders.if.bind.call(this,e)},unbind:function(){return t.public.binders.if.unbind.call(this)},routine:function(e,i){return t.public.binders.if.routine.call(this,e,!i)},update:function(e){return t.public.binders.if.update.call(this,e)}},t.public.binders["on-*"]={function:!0,priority:1e3,unbind:function(e){return this.handler?t.Util.unbindEvent(e,this.args[0],this.handler):void 0},routine:function(e,i){return this.handler&&t.Util.unbindEvent(e,this.args[0],this.handler),t.Util.bindEvent(e,this.args[0],this.handler=this.eventHandler(i))}},t.public.binders["each-*"]={block:!0,priority:4e3,bind:function(t){var e,i,n,r,s;if(null==this.marker)e=[this.view.prefix,this.type].join("-").replace("--","-"),this.marker=document.createComment(" rivets: "+this.type+" "),this.iterated=[],t.removeAttribute(e),t.parentNode.insertBefore(this.marker,t),t.parentNode.removeChild(t);else for(s=this.iterated,n=0,r=s.length;r>n;n++)i=s[n],i.bind()},unbind:function(){var t,e,i,n,r;if(null!=this.iterated){for(n=this.iterated,r=[],e=0,i=n.length;i>e;e++)t=n[e],r.push(t.unbind());return r}},routine:function(e,i){var n,r,s,o,a,l,u,h,d,p,c,f,b,v,y,m,g,w,k,x,M;if(u=this.args[0],i=i||[],this.iterated.length>i.length)for(w=Array(this.iterated.length-i.length),f=0,y=w.length;y>f;f++)s=w[f],c=this.iterated.pop(),c.unbind(),this.marker.parentNode.removeChild(c.els[0]);for(o=b=0,m=i.length;m>b;o=++b)if(l=i[o],r={index:o},r[u]=l,null==this.iterated[o]){k=this.view.models;for(a in k)l=k[a],null==r[a]&&(r[a]=l);d=this.iterated.length?this.iterated[this.iterated.length-1].els[0]:this.marker,h=this.view.options(),h.preloadData=!0,p=e.cloneNode(!0),c=new t.View(p,r,h),c.bind(),this.iterated.push(c),this.marker.parentNode.insertBefore(p,d.nextSibling)}else this.iterated[o].models[u]!==l&&this.iterated[o].update(r);if("OPTION"===e.nodeName){for(x=this.view.bindings,M=[],v=0,g=x.length;g>v;v++)n=x[v],n.el===this.marker.parentNode&&"value"===n.type?M.push(n.sync()):M.push(void 0);return M}},update:function(t){var e,i,n,r,s,o,a,l;e={};for(i in t)n=t[i],i!==this.args[0]&&(e[i]=n);for(a=this.iterated,l=[],s=0,o=a.length;o>s;s++)r=a[s],l.push(r.update(e));return l}},t.public.binders["class-*"]=function(t,e){var i;return i=" "+t.className+" ",!e==(-1!==i.indexOf(" "+this.args[0]+" "))?t.className=e?""+t.className+" "+this.args[0]:i.replace(" "+this.args[0]+" "," ").trim():void 0},t.public.binders["*"]=function(t,e){return null!=e?t.setAttribute(this.type,e):t.removeAttribute(this.type)},t.public.adapters["."]={id:"_rv",counter:0,weakmap:{},weakReference:function(t){var e,i,n;return t.hasOwnProperty(this.id)||(e=this.counter++,Object.defineProperty(t,this.id,{value:e})),(i=this.weakmap)[n=t[this.id]]||(i[n]={callbacks:{}})},cleanupWeakReference:function(t,e){return Object.keys(t.callbacks).length||t.pointers&&Object.keys(t.pointers).length?void 0:delete this.weakmap[e]},stubFunction:function(t,e){var i,n,r;return n=t[e],i=this.weakReference(t),r=this.weakmap,t[e]=function(){var e,s,o,a,l,u,h,d,p,c;a=n.apply(t,arguments),h=i.pointers;for(o in h)for(s=h[o],c=null!=(d=null!=(p=r[o])?p.callbacks[s]:void 0)?d:[],l=0,u=c.length;u>l;l++)(e=c[l])();return a}},observeMutations:function(t,e,i){var n,r,s,o,a,u;if(Array.isArray(t)){if(s=this.weakReference(t),null==s.pointers)for(s.pointers={},r=["push","pop","shift","unshift","sort","reverse","splice"],a=0,u=r.length;u>a;a++)n=r[a],this.stubFunction(t,n);if(null==(o=s.pointers)[e]&&(o[e]=[]),l.call(s.pointers[e],i)<0)return s.pointers[e].push(i)}},unobserveMutations:function(t,e,i){var n,r,s;return Array.isArray(t)&&null!=t[this.id]&&(r=this.weakmap[t[this.id]])&&(s=r.pointers[e])?((n=s.indexOf(i))>=0&&s.splice(n,1),s.length||delete r.pointers[e],this.cleanupWeakReference(r,t[this.id])):void 0},observe:function(t,e,i){var n,r,s;return n=this.weakReference(t).callbacks,null==n[e]&&(n[e]=[],r=Object.getOwnPropertyDescriptor(t,e),(null!=r?r.get:void 0)||(null!=r?r.set:void 0)||(s=t[e],Object.defineProperty(t,e,{enumerable:!0,get:function(){return s},set:function(r){return function(o){var a,u,h,d;if(o!==s&&(r.unobserveMutations(s,t[r.id],e),s=o,a=r.weakmap[t[r.id]])){if(n=a.callbacks,n[e])for(d=n[e].slice(),u=0,h=d.length;h>u;u++)i=d[u],l.call(n[e],i)>=0&&i();return r.observeMutations(o,t[r.id],e)}}}(this)}))),l.call(n[e],i)<0&&n[e].push(i),this.observeMutations(t[e],t[this.id],e)},unobserve:function(t,e,i){var n,r,s;return(s=this.weakmap[t[this.id]])&&(n=s.callbacks[e])?((r=n.indexOf(i))>=0&&(n.splice(r,1),n.length||delete s.callbacks[e]),this.unobserveMutations(t[e],t[this.id],e),this.cleanupWeakReference(s,t[this.id])):void 0},get:function(t,e){return t[e]},set:function(t,e,i){return t[e]=i}},t.factory=function(e){return t.sightglass=e,t.public._=t,t.public},"object"==typeof("undefined"!=typeof module&&null!==module?module.exports:void 0)?module.exports=t.factory(require("sightglass")):"function"==typeof define&&define.amd?define("rivets.vendor",["sightglass"],function(e){return this.rivets=t.factory(e)}):this.rivets=t.factory(sightglass)}.call(this),define("rivets",["rivets.vendor"],function(t){return t.configure({prefix:"data-rv",preloadData:!0,rootInterface:".",templateDelimiters:["{{","}}"],handler:function(t,e,i){this.call(t,e,i.view.models)}}),t.binders.show=function(t,e){e?($(t).removeClass("hidden"),$(t).removeAttr("hidden")):($(t).addClass("hidden"),$(t).attr("hidden",!0)),$(t).attr("aria-hidden",!e)},t.binders.hide=function(e,i){t.binders.show(e,0==i)},t.binders.remaininglength=function(t,e){var i=$(t),n=i.attr("maxlength");"undefined"!=typeof n&&i.text(n-e.length)},t.binders.showsuccess=function(e,i){t.binders.show(e,i),i&&$(e).focus()},t.binders.showerrorifnot=function(e,i){t.binders.hide(e,i),i||$(e).focus()},t.binders.fielderror=function(e,i){var n=$(e),r=n.parent();i?(t.binders.show(e,i),n.addClass("form-error"),n.text(i),r.is("label")&&(r=r.parent()),r.addClass("has-error")):(t.binders.hide(e,i),n.removeClass("form-error"),n.text(""),r.is("label")&&(r=r.parent()),r.removeClass("has-error"))},t.binders.groupfielderror=function(e,i){var n=$(e),r=n.attr("aria-labelledby"),s=$("#"+r).closest(".form-group");i?(t.binders.show(e,i),n.text(i),n.addClass("form-error"),s.addClass("has-error")):(t.binders.hide(e,i),n.removeClass("form-error"),s.removeClass("has-error"))},t.binders.translatefamilymember=function(t,e){var i=$(t);if(i.text(e.givenName+" "+e.name),e.birthDate){var n="";switch(e.gender){case"1":n=" - né le "+e.birthDate;break;case"2":n=" - née le "+e.birthDate;break;default:n=" - né(e) le "+e.birthDate}i.append('<span class="small">'+n+"</span>")}},t.formatters.parenthesis=function(t){return"("+t+")"},t.formatters.and=function(t,e){return t&&e},t.formatters.prefix=function(t,e){return e+t},t.formatters.or=function(t,e){return t||e},t.formatters.orNot=function(e,i){return t.formatters.or(e,!i)},t.formatters.andNot=function(e,i){return t.formatters.and(e,!i)},t.formatters.not=function(t){return!t},t.formatters.eq=function(t,e){return t==e},t.formatters.notEq=function(t,e){return t!=e},t.formatters.boolean=function(t){return t?"Oui":"Non"},t.formatters.localDate=function(t){return t instanceof Date?t.toLocaleDateString():t},t.formatters.concat=function(t){t||(t="");var e=Array.prototype.slice.call(arguments);return e.shift(),e.join(t)},t.formatters.addExtToFileName=function(){var t=Array.prototype.slice.call(arguments);return null===t[1]||""===t[1]?t[0]:t.join(".")},t.formatters.add=function(t,e){return parseInt(e)+parseInt(t)},console.log("Rivets.js loaded"),t}),define("sp/errors/errorsHandler",["jquery"],function(t){"use strict";return function(){function e(t,e){var r=i(t),s=n(t,e);return r.length===s.length&&(r=s),r}function i(t){var e=[];for(var i in t)t.hasOwnProperty(i)&&void 0!==t[i]&&(e=r(t,i,e));return e}function n(t,e){var i=[];return null!==e&&e.length>0&&e.forEach(function(e){t.hasOwnProperty(e)&&void 0!==t[e]&&(i=r(t,e,i))}),i}function r(t,e,i){if(null!==t[e]){var n=s(e);n+=o(e),i.push(n)}return i}function s(e){var i=a(e).attr("aria-describedby"),n=i?t("#"+i).html()+" : ":"";return n}function o(e){var i=a(e),n=i.attr("aria-labelledby"),r=n?t("#"+n):l(i);return r.html()}function a(e){var i=t("span[data-rv-fielderror='fieldErrors.errorMap."+e+"']");return 0===i.length&&(i=t("span[data-rv-groupfielderror='fieldErrors.errorMap."+e+"']")),i}function l(t){return t.parent().clone().children("span, div, button").remove().end()}var u={errorMap:{},fieldLabels:[],empty:!0},h=function(t,i){u.empty=Object.keys(t).length<1,u.errorMap=t,u.fieldLabels=e(t,i)};return{buildFieldErrors:h,fieldErrors:u}}}),define("sp/super/InfoForm",["jquery","rivets","sp/global","sp/errors/errorsHandler"],function(t,e,i,n){"use strict";var r=function(){var e=this;e._errorsHandler=new n,e._displayableModel=null,e._editableModel=null,e._controller=null,e._messages={list:[],empty:!0},e._state={success:!1},e.updateMessages=function(t){e._messages.list=t,e._messages.empty=t.length<1},e.initModel=function(t,i){e._displayableModel=t.copy(i),e._displayableModel.displayMode=!0,e._displayableModel.updateIsEmptyFlag(),e._editableModel=new t},e.reset=function(){e._errorsHandler.buildFieldErrors([],[]),e.updateMessages([])},e.modelUpdateSuccess=function(t,i){e._displayableModel.updateFrom(i),e._displayableModel.updateIsEmptyFlag(),e._displayableModel.displayMode=!0,e.reset(),e._state.success=!0},e.modelUpdateError=function(i,n){var r=JSON.parse(n.responseText);e.updateMessages(r.messages);var s=[];try{s=e._displayableModel.getCompleteSortedFieldKeyList()}catch(t){}e._errorsHandler.buildFieldErrors(r.fieldMessages,s),e._state.success=!1,t(".alert.alert-bloc.alert-danger").is(":visible")&&t(".alert.alert-bloc.alert-danger").focus()},e.buildController=function(n,r,s){return{trigger:function(){e._displayableModel.displayMode?e._displayableModel.isEmpty=!1:e._displayableModel.updateIsEmptyFlag(),e._displayableModel.displayMode=!e._displayableModel.displayMode,e._editableModel.updateFrom(e._displayableModel),e.reset(),e._state.success=!1,t(n).focus()},cancel:function(n){n.preventDefault(),e._displayableModel.displayMode=!0,e._displayableModel.updateIsEmptyFlag(),e._displayableModel.isEmpty?t(r).focus():t(s).focus(),e._state.success=!1,i.updateTitleOnErrorMessage()}}}};return r.prototype.init=function(n,r,s,o,a,l,u){var h=this;h.initModel(n,r),h._controller=h.buildController(a,l,u),i.bindSingleFormRetrieveJson(o,h.modelUpdateError,h.modelUpdateSuccess),h.rview=e.bind(t(s),{displayableModel:h._displayableModel,editableModel:h._editableModel,controller:h._controller,messages:h._messages,fieldErrors:h._errorsHandler.fieldErrors,state:h._state})},r.prototype.getDisplayableModel=function(){return this._displayableModel},r.prototype.getEditableModel=function(){return this._editableModel},r.prototype.getMessages=function(){return this._messages},r.prototype.getState=function(){return this._state},r.prototype.getErrorsHandler=function(){return this._errorsHandler},r.prototype.getController=function(){return this._controller},r}),define("sp/url",[],function(){function t(t){this.url=t,this.hasParameter=function(t){return!!this.url.match("[?&]{1}"+t+"=")},this.getParameterByName=function(t){for(var e,i,n=this.getQueryParams(),r=0;r<n.length;r+=1){var s=n[r].indexOf("=");if(s>-1?(e=n[r].slice(0,s),i=n[r].substring(s+1)):(e=n[r],i=""),e===t)return i}return null},this.deleteParam=function(t){for(var e=this.url.split("?")[0],i=this.url.split("#")[1],n=this.getQueryParams(),r=0;r<n.length;r+=1){var s=n[r].split("=")[0];s===t&&n.splice(r,1)}return this.buildUrl(e,n,i),this.url},this.getQueryParams=function(){var t=this.url.indexOf("?")+1;return t?this.url.substring(t).split("&"):[]},this.buildUrl=function(t,e,i){e&&e.length>0&&(t=t+"?"+e.join("&")),i&&(t=t+"#"+i),this.url=t}}return t}),define("sp/associations/CreateAssoSpace",["sp/global","sp/modalHelper","sp/super/InfoForm","sp/url"],function(t,e,i,n){
"use strict";var r=function(){this.associationName=""};r.prototype.updateFrom=function(t){return this.associationName=t.associationName,this},r.copy=function(t){return(new r).updateFrom(t)},r.prototype.updateIsEmptyFlag=function(){this.isEmpty=!this.associationName};var s,o=i.prototype,a=function(){i.call(this),s=this},l=function(t){var e,i=new n(t.location.href),r=i.getParameterByName("targetUrl"),s=null!==r;e=s?r:"/compte/informations",t.location.href=e};return a.prototype=Object.create(o),a.prototype.init=function(t){s.modelUpdateSuccess=function(){l(window)};var i="#createAssoSpaceModal",n="#createAssoSpaceForm";o.init.call(this,r,t,"#createAssoSpace",n,"#associationName"),e.setupFocus(i,"#usernameNavTop"),e.disableButtonOnClick(),e.cleanFormOnHideModal(s,i,n)},a.prototype.AssoSpaceModel=r,a.prototype.successCallback=l,a}),require(["jquery","sp/associations/CreateAssoSpace","domReady"],function(t,e,i){i(function(){(new e).init({})})}),define("../app/bulleIdentite",function(){});