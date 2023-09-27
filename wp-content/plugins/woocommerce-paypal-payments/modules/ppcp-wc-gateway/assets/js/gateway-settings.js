/*! For license information please see gateway-settings.js.LICENSE.txt */
(()=>{var t={922:t=>{"use strict";var e=function(t){return function(t){return!!t&&"object"==typeof t}(t)&&!function(t){var e=Object.prototype.toString.call(t);return"[object RegExp]"===e||"[object Date]"===e||function(t){return t.$$typeof===r}(t)}(t)},r="function"==typeof Symbol&&Symbol.for?Symbol.for("react.element"):60103;function n(t,e){return!1!==e.clone&&e.isMergeableObject(t)?u((r=t,Array.isArray(r)?[]:{}),t,e):t;var r}function o(t,e,r){return t.concat(e).map((function(t){return n(t,r)}))}function i(t){return Object.keys(t).concat(function(t){return Object.getOwnPropertySymbols?Object.getOwnPropertySymbols(t).filter((function(e){return t.propertyIsEnumerable(e)})):[]}(t))}function a(t,e){try{return e in t}catch(t){return!1}}function u(t,r,c){(c=c||{}).arrayMerge=c.arrayMerge||o,c.isMergeableObject=c.isMergeableObject||e,c.cloneUnlessOtherwiseSpecified=n;var s=Array.isArray(r);return s===Array.isArray(t)?s?c.arrayMerge(t,r,c):function(t,e,r){var o={};return r.isMergeableObject(t)&&i(t).forEach((function(e){o[e]=n(t[e],r)})),i(e).forEach((function(i){(function(t,e){return a(t,e)&&!(Object.hasOwnProperty.call(t,e)&&Object.propertyIsEnumerable.call(t,e))})(t,i)||(a(t,i)&&r.isMergeableObject(e[i])?o[i]=function(t,e){if(!e.customMerge)return u;var r=e.customMerge(t);return"function"==typeof r?r:u}(i,r)(t[i],e[i],r):o[i]=n(e[i],r))})),o}(t,r,c):n(r,c)}u.all=function(t,e){if(!Array.isArray(t))throw new Error("first argument should be an array");return t.reduce((function(t,r){return u(t,r,e)}),{})};var c=u;t.exports=c},9662:(t,e,r)=>{var n=r(614),o=r(6330),i=TypeError;t.exports=function(t){if(n(t))return t;throw i(o(t)+" is not a function")}},9670:(t,e,r)=>{var n=r(111),o=String,i=TypeError;t.exports=function(t){if(n(t))return t;throw i(o(t)+" is not an object")}},8533:(t,e,r)=>{"use strict";var n=r(2092).forEach,o=r(9341)("forEach");t.exports=o?[].forEach:function(t){return n(this,t,arguments.length>1?arguments[1]:void 0)}},1318:(t,e,r)=>{var n=r(5656),o=r(1400),i=r(6244),a=function(t){return function(e,r,a){var u,c=n(e),s=i(c),l=o(a,s);if(t&&r!=r){for(;s>l;)if((u=c[l++])!=u)return!0}else for(;s>l;l++)if((t||l in c)&&c[l]===r)return t||l||0;return!t&&-1}};t.exports={includes:a(!0),indexOf:a(!1)}},2092:(t,e,r)=>{var n=r(9974),o=r(1702),i=r(8361),a=r(7908),u=r(6244),c=r(5417),s=o([].push),l=function(t){var e=1==t,r=2==t,o=3==t,l=4==t,p=6==t,f=7==t,d=5==t||p;return function(y,h,v,b){for(var g,m,w=a(y),S=i(w),x=n(h,v),j=u(S),O=0,E=b||c,_=e?E(y,j):r||f?E(y,0):void 0;j>O;O++)if((d||O in S)&&(m=x(g=S[O],O,w),t))if(e)_[O]=m;else if(m)switch(t){case 3:return!0;case 5:return g;case 6:return O;case 2:s(_,g)}else switch(t){case 4:return!1;case 7:s(_,g)}return p?-1:o||l?l:_}};t.exports={forEach:l(0),map:l(1),filter:l(2),some:l(3),every:l(4),find:l(5),findIndex:l(6),filterReject:l(7)}},1194:(t,e,r)=>{var n=r(7293),o=r(5112),i=r(7392),a=o("species");t.exports=function(t){return i>=51||!n((function(){var e=[];return(e.constructor={})[a]=function(){return{foo:1}},1!==e[t](Boolean).foo}))}},9341:(t,e,r)=>{"use strict";var n=r(7293);t.exports=function(t,e){var r=[][t];return!!r&&n((function(){r.call(null,e||function(){return 1},1)}))}},206:(t,e,r)=>{var n=r(1702);t.exports=n([].slice)},7475:(t,e,r)=>{var n=r(3157),o=r(4411),i=r(111),a=r(5112)("species"),u=Array;t.exports=function(t){var e;return n(t)&&(e=t.constructor,(o(e)&&(e===u||n(e.prototype))||i(e)&&null===(e=e[a]))&&(e=void 0)),void 0===e?u:e}},5417:(t,e,r)=>{var n=r(7475);t.exports=function(t,e){return new(n(t))(0===e?0:e)}},4326:(t,e,r)=>{var n=r(1702),o=n({}.toString),i=n("".slice);t.exports=function(t){return i(o(t),8,-1)}},648:(t,e,r)=>{var n=r(1694),o=r(614),i=r(4326),a=r(5112)("toStringTag"),u=Object,c="Arguments"==i(function(){return arguments}());t.exports=n?i:function(t){var e,r,n;return void 0===t?"Undefined":null===t?"Null":"string"==typeof(r=function(t,e){try{return t[e]}catch(t){}}(e=u(t),a))?r:c?i(e):"Object"==(n=i(e))&&o(e.callee)?"Arguments":n}},9920:(t,e,r)=>{var n=r(2597),o=r(3887),i=r(1236),a=r(3070);t.exports=function(t,e,r){for(var u=o(e),c=a.f,s=i.f,l=0;l<u.length;l++){var p=u[l];n(t,p)||r&&n(r,p)||c(t,p,s(e,p))}}},8880:(t,e,r)=>{var n=r(9781),o=r(3070),i=r(9114);t.exports=n?function(t,e,r){return o.f(t,e,i(1,r))}:function(t,e,r){return t[e]=r,t}},9114:t=>{t.exports=function(t,e){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:e}}},6135:(t,e,r)=>{"use strict";var n=r(4948),o=r(3070),i=r(9114);t.exports=function(t,e,r){var a=n(e);a in t?o.f(t,a,i(0,r)):t[a]=r}},8052:(t,e,r)=>{var n=r(614),o=r(3070),i=r(6339),a=r(3072);t.exports=function(t,e,r,u){u||(u={});var c=u.enumerable,s=void 0!==u.name?u.name:e;if(n(r)&&i(r,s,u),u.global)c?t[e]=r:a(e,r);else{try{u.unsafe?t[e]&&(c=!0):delete t[e]}catch(t){}c?t[e]=r:o.f(t,e,{value:r,enumerable:!1,configurable:!u.nonConfigurable,writable:!u.nonWritable})}return t}},3072:(t,e,r)=>{var n=r(7854),o=Object.defineProperty;t.exports=function(t,e){try{o(n,t,{value:e,configurable:!0,writable:!0})}catch(r){n[t]=e}return e}},9781:(t,e,r)=>{var n=r(7293);t.exports=!n((function(){return 7!=Object.defineProperty({},1,{get:function(){return 7}})[1]}))},317:(t,e,r)=>{var n=r(7854),o=r(111),i=n.document,a=o(i)&&o(i.createElement);t.exports=function(t){return a?i.createElement(t):{}}},7207:t=>{var e=TypeError;t.exports=function(t){if(t>9007199254740991)throw e("Maximum allowed index exceeded");return t}},8324:t=>{t.exports={CSSRuleList:0,CSSStyleDeclaration:0,CSSValueList:0,ClientRectList:0,DOMRectList:0,DOMStringList:0,DOMTokenList:1,DataTransferItemList:0,FileList:0,HTMLAllCollection:0,HTMLCollection:0,HTMLFormElement:0,HTMLSelectElement:0,MediaList:0,MimeTypeArray:0,NamedNodeMap:0,NodeList:1,PaintRequestList:0,Plugin:0,PluginArray:0,SVGLengthList:0,SVGNumberList:0,SVGPathSegList:0,SVGPointList:0,SVGStringList:0,SVGTransformList:0,SourceBufferList:0,StyleSheetList:0,TextTrackCueList:0,TextTrackList:0,TouchList:0}},8509:(t,e,r)=>{var n=r(317)("span").classList,o=n&&n.constructor&&n.constructor.prototype;t.exports=o===Object.prototype?void 0:o},8113:(t,e,r)=>{var n=r(5005);t.exports=n("navigator","userAgent")||""},7392:(t,e,r)=>{var n,o,i=r(7854),a=r(8113),u=i.process,c=i.Deno,s=u&&u.versions||c&&c.version,l=s&&s.v8;l&&(o=(n=l.split("."))[0]>0&&n[0]<4?1:+(n[0]+n[1])),!o&&a&&(!(n=a.match(/Edge\/(\d+)/))||n[1]>=74)&&(n=a.match(/Chrome\/(\d+)/))&&(o=+n[1]),t.exports=o},748:t=>{t.exports=["constructor","hasOwnProperty","isPrototypeOf","propertyIsEnumerable","toLocaleString","toString","valueOf"]},2109:(t,e,r)=>{var n=r(7854),o=r(1236).f,i=r(8880),a=r(8052),u=r(3072),c=r(9920),s=r(4705);t.exports=function(t,e){var r,l,p,f,d,y=t.target,h=t.global,v=t.stat;if(r=h?n:v?n[y]||u(y,{}):(n[y]||{}).prototype)for(l in e){if(f=e[l],p=t.dontCallGetSet?(d=o(r,l))&&d.value:r[l],!s(h?l:y+(v?".":"#")+l,t.forced)&&void 0!==p){if(typeof f==typeof p)continue;c(f,p)}(t.sham||p&&p.sham)&&i(f,"sham",!0),a(r,l,f,t)}}},7293:t=>{t.exports=function(t){try{return!!t()}catch(t){return!0}}},2104:(t,e,r)=>{var n=r(4374),o=Function.prototype,i=o.apply,a=o.call;t.exports="object"==typeof Reflect&&Reflect.apply||(n?a.bind(i):function(){return a.apply(i,arguments)})},9974:(t,e,r)=>{var n=r(1702),o=r(9662),i=r(4374),a=n(n.bind);t.exports=function(t,e){return o(t),void 0===e?t:i?a(t,e):function(){return t.apply(e,arguments)}}},4374:(t,e,r)=>{var n=r(7293);t.exports=!n((function(){var t=function(){}.bind();return"function"!=typeof t||t.hasOwnProperty("prototype")}))},6916:(t,e,r)=>{var n=r(4374),o=Function.prototype.call;t.exports=n?o.bind(o):function(){return o.apply(o,arguments)}},6530:(t,e,r)=>{var n=r(9781),o=r(2597),i=Function.prototype,a=n&&Object.getOwnPropertyDescriptor,u=o(i,"name"),c=u&&"something"===function(){}.name,s=u&&(!n||n&&a(i,"name").configurable);t.exports={EXISTS:u,PROPER:c,CONFIGURABLE:s}},1702:(t,e,r)=>{var n=r(4374),o=Function.prototype,i=o.bind,a=o.call,u=n&&i.bind(a,a);t.exports=n?function(t){return t&&u(t)}:function(t){return t&&function(){return a.apply(t,arguments)}}},5005:(t,e,r)=>{var n=r(7854),o=r(614),i=function(t){return o(t)?t:void 0};t.exports=function(t,e){return arguments.length<2?i(n[t]):n[t]&&n[t][e]}},8173:(t,e,r)=>{var n=r(9662),o=r(8554);t.exports=function(t,e){var r=t[e];return o(r)?void 0:n(r)}},7854:(t,e,r)=>{var n=function(t){return t&&t.Math==Math&&t};t.exports=n("object"==typeof globalThis&&globalThis)||n("object"==typeof window&&window)||n("object"==typeof self&&self)||n("object"==typeof r.g&&r.g)||function(){return this}()||Function("return this")()},2597:(t,e,r)=>{var n=r(1702),o=r(7908),i=n({}.hasOwnProperty);t.exports=Object.hasOwn||function(t,e){return i(o(t),e)}},3501:t=>{t.exports={}},4664:(t,e,r)=>{var n=r(9781),o=r(7293),i=r(317);t.exports=!n&&!o((function(){return 7!=Object.defineProperty(i("div"),"a",{get:function(){return 7}}).a}))},8361:(t,e,r)=>{var n=r(1702),o=r(7293),i=r(4326),a=Object,u=n("".split);t.exports=o((function(){return!a("z").propertyIsEnumerable(0)}))?function(t){return"String"==i(t)?u(t,""):a(t)}:a},2788:(t,e,r)=>{var n=r(1702),o=r(614),i=r(5465),a=n(Function.toString);o(i.inspectSource)||(i.inspectSource=function(t){return a(t)}),t.exports=i.inspectSource},9909:(t,e,r)=>{var n,o,i,a=r(4811),u=r(7854),c=r(1702),s=r(111),l=r(8880),p=r(2597),f=r(5465),d=r(6200),y=r(3501),h="Object already initialized",v=u.TypeError,b=u.WeakMap;if(a||f.state){var g=f.state||(f.state=new b),m=c(g.get),w=c(g.has),S=c(g.set);n=function(t,e){if(w(g,t))throw v(h);return e.facade=t,S(g,t,e),e},o=function(t){return m(g,t)||{}},i=function(t){return w(g,t)}}else{var x=d("state");y[x]=!0,n=function(t,e){if(p(t,x))throw v(h);return e.facade=t,l(t,x,e),e},o=function(t){return p(t,x)?t[x]:{}},i=function(t){return p(t,x)}}t.exports={set:n,get:o,has:i,enforce:function(t){return i(t)?o(t):n(t,{})},getterFor:function(t){return function(e){var r;if(!s(e)||(r=o(e)).type!==t)throw v("Incompatible receiver, "+t+" required");return r}}}},3157:(t,e,r)=>{var n=r(4326);t.exports=Array.isArray||function(t){return"Array"==n(t)}},614:t=>{t.exports=function(t){return"function"==typeof t}},4411:(t,e,r)=>{var n=r(1702),o=r(7293),i=r(614),a=r(648),u=r(5005),c=r(2788),s=function(){},l=[],p=u("Reflect","construct"),f=/^\s*(?:class|function)\b/,d=n(f.exec),y=!f.exec(s),h=function(t){if(!i(t))return!1;try{return p(s,l,t),!0}catch(t){return!1}},v=function(t){if(!i(t))return!1;switch(a(t)){case"AsyncFunction":case"GeneratorFunction":case"AsyncGeneratorFunction":return!1}try{return y||!!d(f,c(t))}catch(t){return!0}};v.sham=!0,t.exports=!p||o((function(){var t;return h(h.call)||!h(Object)||!h((function(){t=!0}))||t}))?v:h},4705:(t,e,r)=>{var n=r(7293),o=r(614),i=/#|\.prototype\./,a=function(t,e){var r=c[u(t)];return r==l||r!=s&&(o(e)?n(e):!!e)},u=a.normalize=function(t){return String(t).replace(i,".").toLowerCase()},c=a.data={},s=a.NATIVE="N",l=a.POLYFILL="P";t.exports=a},8554:t=>{t.exports=function(t){return null==t}},111:(t,e,r)=>{var n=r(614),o="object"==typeof document&&document.all,i=void 0===o&&void 0!==o;t.exports=i?function(t){return"object"==typeof t?null!==t:n(t)||t===o}:function(t){return"object"==typeof t?null!==t:n(t)}},1913:t=>{t.exports=!1},2190:(t,e,r)=>{var n=r(5005),o=r(614),i=r(7976),a=r(3307),u=Object;t.exports=a?function(t){return"symbol"==typeof t}:function(t){var e=n("Symbol");return o(e)&&i(e.prototype,u(t))}},6244:(t,e,r)=>{var n=r(7466);t.exports=function(t){return n(t.length)}},6339:(t,e,r)=>{var n=r(7293),o=r(614),i=r(2597),a=r(9781),u=r(6530).CONFIGURABLE,c=r(2788),s=r(9909),l=s.enforce,p=s.get,f=Object.defineProperty,d=a&&!n((function(){return 8!==f((function(){}),"length",{value:8}).length})),y=String(String).split("String"),h=t.exports=function(t,e,r){"Symbol("===String(e).slice(0,7)&&(e="["+String(e).replace(/^Symbol\(([^)]*)\)/,"$1")+"]"),r&&r.getter&&(e="get "+e),r&&r.setter&&(e="set "+e),(!i(t,"name")||u&&t.name!==e)&&(a?f(t,"name",{value:e,configurable:!0}):t.name=e),d&&r&&i(r,"arity")&&t.length!==r.arity&&f(t,"length",{value:r.arity});try{r&&i(r,"constructor")&&r.constructor?a&&f(t,"prototype",{writable:!1}):t.prototype&&(t.prototype=void 0)}catch(t){}var n=l(t);return i(n,"source")||(n.source=y.join("string"==typeof e?e:"")),t};Function.prototype.toString=h((function(){return o(this)&&p(this).source||c(this)}),"toString")},4758:t=>{var e=Math.ceil,r=Math.floor;t.exports=Math.trunc||function(t){var n=+t;return(n>0?r:e)(n)}},3009:(t,e,r)=>{var n=r(7854),o=r(7293),i=r(1702),a=r(1340),u=r(3111).trim,c=r(1361),s=n.parseInt,l=n.Symbol,p=l&&l.iterator,f=/^[+-]?0x/i,d=i(f.exec),y=8!==s(c+"08")||22!==s(c+"0x16")||p&&!o((function(){s(Object(p))}));t.exports=y?function(t,e){var r=u(a(t));return s(r,e>>>0||(d(f,r)?16:10))}:s},3070:(t,e,r)=>{var n=r(9781),o=r(4664),i=r(3353),a=r(9670),u=r(4948),c=TypeError,s=Object.defineProperty,l=Object.getOwnPropertyDescriptor;e.f=n?i?function(t,e,r){if(a(t),e=u(e),a(r),"function"==typeof t&&"prototype"===e&&"value"in r&&"writable"in r&&!r.writable){var n=l(t,e);n&&n.writable&&(t[e]=r.value,r={configurable:"configurable"in r?r.configurable:n.configurable,enumerable:"enumerable"in r?r.enumerable:n.enumerable,writable:!1})}return s(t,e,r)}:s:function(t,e,r){if(a(t),e=u(e),a(r),o)try{return s(t,e,r)}catch(t){}if("get"in r||"set"in r)throw c("Accessors not supported");return"value"in r&&(t[e]=r.value),t}},1236:(t,e,r)=>{var n=r(9781),o=r(6916),i=r(5296),a=r(9114),u=r(5656),c=r(4948),s=r(2597),l=r(4664),p=Object.getOwnPropertyDescriptor;e.f=n?p:function(t,e){if(t=u(t),e=c(e),l)try{return p(t,e)}catch(t){}if(s(t,e))return a(!o(i.f,t,e),t[e])}},8006:(t,e,r)=>{var n=r(6324),o=r(748).concat("length","prototype");e.f=Object.getOwnPropertyNames||function(t){return n(t,o)}},5181:(t,e)=>{e.f=Object.getOwnPropertySymbols},7976:(t,e,r)=>{var n=r(1702);t.exports=n({}.isPrototypeOf)},6324:(t,e,r)=>{var n=r(1702),o=r(2597),i=r(5656),a=r(1318).indexOf,u=r(3501),c=n([].push);t.exports=function(t,e){var r,n=i(t),s=0,l=[];for(r in n)!o(u,r)&&o(n,r)&&c(l,r);for(;e.length>s;)o(n,r=e[s++])&&(~a(l,r)||c(l,r));return l}},1956:(t,e,r)=>{var n=r(6324),o=r(748);t.exports=Object.keys||function(t){return n(t,o)}},5296:(t,e)=>{"use strict";var r={}.propertyIsEnumerable,n=Object.getOwnPropertyDescriptor,o=n&&!r.call({1:2},1);e.f=o?function(t){var e=n(this,t);return!!e&&e.enumerable}:r},288:(t,e,r)=>{"use strict";var n=r(1694),o=r(648);t.exports=n?{}.toString:function(){return"[object "+o(this)+"]"}},2140:(t,e,r)=>{var n=r(6916),o=r(614),i=r(111),a=TypeError;t.exports=function(t,e){var r,u;if("string"===e&&o(r=t.toString)&&!i(u=n(r,t)))return u;if(o(r=t.valueOf)&&!i(u=n(r,t)))return u;if("string"!==e&&o(r=t.toString)&&!i(u=n(r,t)))return u;throw a("Can't convert object to primitive value")}},3887:(t,e,r)=>{var n=r(5005),o=r(1702),i=r(8006),a=r(5181),u=r(9670),c=o([].concat);t.exports=n("Reflect","ownKeys")||function(t){var e=i.f(u(t)),r=a.f;return r?c(e,r(t)):e}},4488:(t,e,r)=>{var n=r(8554),o=TypeError;t.exports=function(t){if(n(t))throw o("Can't call method on "+t);return t}},6200:(t,e,r)=>{var n=r(2309),o=r(9711),i=n("keys");t.exports=function(t){return i[t]||(i[t]=o(t))}},5465:(t,e,r)=>{var n=r(7854),o=r(3072),i="__core-js_shared__",a=n[i]||o(i,{});t.exports=a},2309:(t,e,r)=>{var n=r(1913),o=r(5465);(t.exports=function(t,e){return o[t]||(o[t]=void 0!==e?e:{})})("versions",[]).push({version:"3.25.1",mode:n?"pure":"global",copyright:"© 2014-2022 Denis Pushkarev (zloirock.ru)",license:"https://github.com/zloirock/core-js/blob/v3.25.1/LICENSE",source:"https://github.com/zloirock/core-js"})},3111:(t,e,r)=>{var n=r(1702),o=r(4488),i=r(1340),a=r(1361),u=n("".replace),c="["+a+"]",s=RegExp("^"+c+c+"*"),l=RegExp(c+c+"*$"),p=function(t){return function(e){var r=i(o(e));return 1&t&&(r=u(r,s,"")),2&t&&(r=u(r,l,"")),r}};t.exports={start:p(1),end:p(2),trim:p(3)}},6293:(t,e,r)=>{var n=r(7392),o=r(7293);t.exports=!!Object.getOwnPropertySymbols&&!o((function(){var t=Symbol();return!String(t)||!(Object(t)instanceof Symbol)||!Symbol.sham&&n&&n<41}))},1400:(t,e,r)=>{var n=r(9303),o=Math.max,i=Math.min;t.exports=function(t,e){var r=n(t);return r<0?o(r+e,0):i(r,e)}},5656:(t,e,r)=>{var n=r(8361),o=r(4488);t.exports=function(t){return n(o(t))}},9303:(t,e,r)=>{var n=r(4758);t.exports=function(t){var e=+t;return e!=e||0===e?0:n(e)}},7466:(t,e,r)=>{var n=r(9303),o=Math.min;t.exports=function(t){return t>0?o(n(t),9007199254740991):0}},7908:(t,e,r)=>{var n=r(4488),o=Object;t.exports=function(t){return o(n(t))}},7593:(t,e,r)=>{var n=r(6916),o=r(111),i=r(2190),a=r(8173),u=r(2140),c=r(5112),s=TypeError,l=c("toPrimitive");t.exports=function(t,e){if(!o(t)||i(t))return t;var r,c=a(t,l);if(c){if(void 0===e&&(e="default"),r=n(c,t,e),!o(r)||i(r))return r;throw s("Can't convert object to primitive value")}return void 0===e&&(e="number"),u(t,e)}},4948:(t,e,r)=>{var n=r(7593),o=r(2190);t.exports=function(t){var e=n(t,"string");return o(e)?e:e+""}},1694:(t,e,r)=>{var n={};n[r(5112)("toStringTag")]="z",t.exports="[object z]"===String(n)},1340:(t,e,r)=>{var n=r(648),o=String;t.exports=function(t){if("Symbol"===n(t))throw TypeError("Cannot convert a Symbol value to a string");return o(t)}},6330:t=>{var e=String;t.exports=function(t){try{return e(t)}catch(t){return"Object"}}},9711:(t,e,r)=>{var n=r(1702),o=0,i=Math.random(),a=n(1..toString);t.exports=function(t){return"Symbol("+(void 0===t?"":t)+")_"+a(++o+i,36)}},3307:(t,e,r)=>{var n=r(6293);t.exports=n&&!Symbol.sham&&"symbol"==typeof Symbol.iterator},3353:(t,e,r)=>{var n=r(9781),o=r(7293);t.exports=n&&o((function(){return 42!=Object.defineProperty((function(){}),"prototype",{value:42,writable:!1}).prototype}))},4811:(t,e,r)=>{var n=r(7854),o=r(614),i=n.WeakMap;t.exports=o(i)&&/native code/.test(String(i))},5112:(t,e,r)=>{var n=r(7854),o=r(2309),i=r(2597),a=r(9711),u=r(6293),c=r(3307),s=o("wks"),l=n.Symbol,p=l&&l.for,f=c?l:l&&l.withoutSetter||a;t.exports=function(t){if(!i(s,t)||!u&&"string"!=typeof s[t]){var e="Symbol."+t;u&&i(l,t)?s[t]=l[t]:s[t]=c&&p?p(e):f(e)}return s[t]}},1361:t=>{t.exports="\t\n\v\f\r                　\u2028\u2029\ufeff"},2222:(t,e,r)=>{"use strict";var n=r(2109),o=r(7293),i=r(3157),a=r(111),u=r(7908),c=r(6244),s=r(7207),l=r(6135),p=r(5417),f=r(1194),d=r(5112),y=r(7392),h=d("isConcatSpreadable"),v=y>=51||!o((function(){var t=[];return t[h]=!1,t.concat()[0]!==t})),b=f("concat"),g=function(t){if(!a(t))return!1;var e=t[h];return void 0!==e?!!e:i(t)};n({target:"Array",proto:!0,arity:1,forced:!v||!b},{concat:function(t){var e,r,n,o,i,a=u(this),f=p(a,0),d=0;for(e=-1,n=arguments.length;e<n;e++)if(g(i=-1===e?a:arguments[e]))for(o=c(i),s(d+o),r=0;r<o;r++,d++)r in i&&l(f,d,i[r]);else s(d+1),l(f,d++,i);return f.length=d,f}})},7042:(t,e,r)=>{"use strict";var n=r(2109),o=r(3157),i=r(4411),a=r(111),u=r(1400),c=r(6244),s=r(5656),l=r(6135),p=r(5112),f=r(1194),d=r(206),y=f("slice"),h=p("species"),v=Array,b=Math.max;n({target:"Array",proto:!0,forced:!y},{slice:function(t,e){var r,n,p,f=s(this),y=c(f),g=u(t,y),m=u(void 0===e?y:e,y);if(o(f)&&(r=f.constructor,(i(r)&&(r===v||o(r.prototype))||a(r)&&null===(r=r[h]))&&(r=void 0),r===v||void 0===r))return d(f,g,m);for(n=new(void 0===r?v:r)(b(m-g,0)),p=0;g<m;g++,p++)g in f&&l(n,p,f[g]);return n.length=p,n}})},8862:(t,e,r)=>{var n=r(2109),o=r(5005),i=r(2104),a=r(6916),u=r(1702),c=r(7293),s=r(3157),l=r(614),p=r(111),f=r(2190),d=r(206),y=r(6293),h=o("JSON","stringify"),v=u(/./.exec),b=u("".charAt),g=u("".charCodeAt),m=u("".replace),w=u(1..toString),S=/[\uD800-\uDFFF]/g,x=/^[\uD800-\uDBFF]$/,j=/^[\uDC00-\uDFFF]$/,O=!y||c((function(){var t=o("Symbol")();return"[null]"!=h([t])||"{}"!=h({a:t})||"{}"!=h(Object(t))})),E=c((function(){return'"\\udf06\\ud834"'!==h("\udf06\ud834")||'"\\udead"'!==h("\udead")})),_=function(t,e){var r=d(arguments),n=e;if((p(e)||void 0!==t)&&!f(t))return s(e)||(e=function(t,e){if(l(n)&&(e=a(n,this,t,e)),!f(e))return e}),r[1]=e,i(h,null,r)},P=function(t,e,r){var n=b(r,e-1),o=b(r,e+1);return v(x,t)&&!v(j,o)||v(j,t)&&!v(x,n)?"\\u"+w(g(t,0),16):t};h&&n({target:"JSON",stat:!0,arity:3,forced:O||E},{stringify:function(t,e,r){var n=d(arguments),o=i(O?_:h,null,n);return E&&"string"==typeof o?m(o,S,P):o}})},7941:(t,e,r)=>{var n=r(2109),o=r(7908),i=r(1956);n({target:"Object",stat:!0,forced:r(7293)((function(){i(1)}))},{keys:function(t){return i(o(t))}})},1539:(t,e,r)=>{var n=r(1694),o=r(8052),i=r(288);n||o(Object.prototype,"toString",i,{unsafe:!0})},1058:(t,e,r)=>{var n=r(2109),o=r(3009);n({global:!0,forced:parseInt!=o},{parseInt:o})},4747:(t,e,r)=>{var n=r(7854),o=r(8324),i=r(8509),a=r(8533),u=r(8880),c=function(t){if(t&&t.forEach!==a)try{u(t,"forEach",a)}catch(e){t.forEach=a}};for(var s in o)o[s]&&c(n[s]&&n[s].prototype);c(i)}},e={};function r(n){var o=e[n];if(void 0!==o)return o.exports;var i=e[n]={exports:{}};return t[n](i,i.exports,r),i.exports}r.n=t=>{var e=t&&t.__esModule?()=>t.default:()=>t;return r.d(e,{a:e}),e},r.d=(t,e)=>{for(var n in e)r.o(e,n)&&!r.o(t,n)&&Object.defineProperty(t,n,{enumerable:!0,get:e[n]})},r.g=function(){if("object"==typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(t){if("object"==typeof window)return window}}(),r.o=(t,e)=>Object.prototype.hasOwnProperty.call(t,e),(()=>{"use strict";function t(t,e){void 0===e&&(e={});var r=document.createElement("script");return r.src=t,Object.keys(e).forEach((function(t){r.setAttribute(t,e[t]),"data-csp-nonce"===t&&r.setAttribute("nonce",e["data-csp-nonce"])})),r}function e(e,r){if(void 0===r&&(r=n()),i(e,r),"undefined"==typeof window)return r.resolve(null);var a=function(t){var e="https://www.paypal.com/sdk/js";t.sdkBaseURL&&(e=t.sdkBaseURL,delete t.sdkBaseURL),function(t){var e=t["merchant-id"],r=t["data-merchant-id"],n="",o="";Array.isArray(e)?e.length>1?(n="*",o=e.toString()):n=e.toString():"string"==typeof e&&e.length>0?n=e:"string"==typeof r&&r.length>0&&(n="*",o=r),t["merchant-id"]=n,t["data-merchant-id"]=o}(t);var r,n,o=Object.keys(t).filter((function(e){return void 0!==t[e]&&null!==t[e]&&""!==t[e]})).reduce((function(e,r){var n=t[r].toString();return"data-"===r.substring(0,5)?e.dataAttributes[r]=n:e.queryParams[r]=n,e}),{queryParams:{},dataAttributes:{}}),i=o.queryParams,a=o.dataAttributes;return{url:"".concat(e,"?").concat((r=i,n="",Object.keys(r).forEach((function(t){0!==n.length&&(n+="&"),n+=t+"="+r[t]})),n)),dataAttributes:a}}(e),u=a.url,c=a.dataAttributes,s=c["data-namespace"]||"paypal",l=o(s);return function(e,r){var n=document.querySelector('script[src="'.concat(e,'"]'));if(null===n)return null;var o=t(e,r),i=n.cloneNode();if(delete i.dataset.uidAuto,Object.keys(i.dataset).length!==Object.keys(o.dataset).length)return null;var a=!0;return Object.keys(i.dataset).forEach((function(t){i.dataset[t]!==o.dataset[t]&&(a=!1)})),a?n:null}(u,c)&&l?r.resolve(l):function(e,r){void 0===r&&(r=n()),i(e,r);var o=e.url,a=e.attributes;if("string"!=typeof o||0===o.length)throw new Error("Invalid url.");if(void 0!==a&&"object"!=typeof a)throw new Error("Expected attributes to be an object.");return new r((function(e,r){if("undefined"==typeof window)return e();!function(e){var r=e.onSuccess,n=e.onError,o=t(e.url,e.attributes);o.onerror=n,o.onload=r,document.head.insertBefore(o,document.head.firstElementChild)}({url:o,attributes:a,onSuccess:function(){return e()},onError:function(){var t=new Error('The script "'.concat(o,'" failed to load.'));return window.fetch?fetch(o).then((function(e){return 200===e.status&&r(t),e.text()})).then((function(t){var e=function(t){var e=t.split("/* Original Error:")[1];return e?e.replace(/\n/g,"").replace("*/","").trim():t}(t);r(new Error(e))})).catch((function(t){r(t)})):r(t)}})}))}({url:u,attributes:c},r).then((function(){var t=o(s);if(t)return t;throw new Error("The window.".concat(s," global variable is not available."))}))}function n(){if("undefined"==typeof Promise)throw new Error("Promise is undefined. To resolve the issue, use a Promise polyfill.");return Promise}function o(t){return window[t]}function i(t,e){if("object"!=typeof t||null===t)throw new Error("Expected an options object.");if(void 0!==e&&"function"!=typeof e)throw new Error("Expected PromisePonyfill to be a function.")}r(1539),r(4747),r(7941),r(2222),r(8862),r(1058),r(7042);var a=function(t,e){var r=null;return function(){for(var n=arguments.length,o=new Array(n),i=0;i<n;i++)o[i]=arguments[i];window.clearTimeout(r),r=window.setTimeout((function(){t.apply(null,o)}),e)}},u=r(922),c=r.n(u);function s(t,e){void 0===e&&(e={});var r=document.createElement("script");return r.src=t,Object.keys(e).forEach((function(t){r.setAttribute(t,e[t]),"data-csp-nonce"===t&&r.setAttribute("nonce",e["data-csp-nonce"])})),r}function l(t){return window[t]}function p(t,e){if("object"!=typeof t||null===t)throw new Error("Expected an options object.");if(void 0!==e&&"function"!=typeof e)throw new Error("Expected PromisePonyfill to be a function.")}const f=new class{constructor(){this.paypal=null,this.buttons=new Map,this.messages=new Map,this.renderEventName="ppcp-render",document.ppcpWidgetBuilderStatus=()=>{console.log({buttons:this.buttons,messages:this.messages})},jQuery(document).off(this.renderEventName).on(this.renderEventName,(()=>{this.renderAll()}))}setPaypal(t){this.paypal=t}registerButtons(t,e){t=this.sanitizeWrapper(t),this.buttons.set(this.toKey(t),{wrapper:t,options:e})}renderButtons(t){if(t=this.sanitizeWrapper(t),!this.buttons.has(this.toKey(t)))return;if(this.hasRendered(t))return;const e=this.buttons.get(this.toKey(t)),r=this.paypal.Buttons(e.options);if(!r.isEligible())return void this.buttons.delete(this.toKey(t));let n=this.buildWrapperTarget(t);n&&r.render(n)}renderAllButtons(){for(const[t,e]of this.buttons)this.renderButtons(t)}registerMessages(t,e){this.messages.set(t,{wrapper:t,options:e})}renderMessages(t){if(!this.messages.has(t))return;if(this.hasRendered(t))return;const e=this.messages.get(t),r=this.paypal.Messages(e.options);r.render(e.wrapper),setTimeout((()=>{this.hasRendered(t)||r.render(e.wrapper)}),100)}renderAllMessages(){for(const[t,e]of this.messages)this.renderMessages(t)}renderAll(){this.renderAllButtons(),this.renderAllMessages()}hasRendered(t){let e=t;if(Array.isArray(t)){e=t[0];for(const r of t.slice(1))e+=" .item-"+r}const r=document.querySelector(e);return r&&r.hasChildNodes()}sanitizeWrapper(t){return Array.isArray(t)&&1===(t=t.filter((t=>!!t))).length&&(t=t[0]),t}buildWrapperTarget(t){let e=t;if(Array.isArray(t)){const r=jQuery(t[0]);if(!r.length)return;const n="item-"+t[1];let o=r.find("."+n);o.length||(o=jQuery(`<div class="${n}"></div>`),r.append(o)),e=o.get(0)}return jQuery(e).length?e:null}toKey(t){return Array.isArray(t)?JSON.stringify(t):t}},d=(t,e,r)=>{const n=(t=>"string"==typeof t?document.querySelector(t):t)(t);n&&(e?(n.classList.remove(r),((t,e,r)=>{jQuery(document).trigger("ppcp-shown",{handler:t,action:"show",selector:e,element:r})})("Hiding.setVisibleByClass",t,n)):(n.classList.add(r),((t,e,r)=>{jQuery(document).trigger("ppcp-hidden",{handler:t,action:"hide",selector:e,element:r})})("Hiding.setVisibleByClass",t,n)))};document.addEventListener("DOMContentLoaded",(function(){document.querySelectorAll(".ppcp-disabled-checkbox").forEach((function(t){return t.setAttribute("disabled","true")}));var t=jQuery("#mainform"),r=document.querySelector("#ppcp-pay_later_button_enabled");if(r){var n=document.querySelector(".ppcp-button-preview.pay-later");r.checked||n.classList.add("disabled"),r.classList.contains("ppcp-disabled-checkbox")&&(n.style.display="none"),r.addEventListener("click",(function(){n.classList.remove("disabled"),r.checked||n.classList.add("disabled")}))}var o=document.querySelector("#ppcp-allow_card_button_gateway");function i(t){h(t,(function(t){var e=document.querySelector(t.button.wrapper);if(e){e.innerHTML="";var r=new class{constructor(t,e,r,n){this.defaultSettings=e,this.creditCardRenderer=t,this.onSmartButtonClick=r,this.onSmartButtonsInit=n,this.buttonsOptions={},this.onButtonsInitListeners={},this.renderedSources=new Set,this.reloadEventName="ppcp-reload-buttons"}render(t,e={},r=(()=>{})){const n=c()(this.defaultSettings,e),o=Object.fromEntries(Object.entries(n.separate_buttons).filter((([t,e])=>document.querySelector(e.wrapper)))),i=0!==Object.keys(o).length;if(i)for(const e of paypal.getFundingSources().filter((t=>!(t in o)))){let r=n.button.style;"paypal"!==e&&(r={shape:r.shape,color:r.color},"paylater"!==e&&delete r.color),this.renderButtons(n.button.wrapper,r,t,i,e)}else this.renderButtons(n.button.wrapper,n.button.style,t,i);this.creditCardRenderer&&this.creditCardRenderer.render(n.hosted_fields.wrapper,r);for(const[e,r]of Object.entries(o))this.renderButtons(r.wrapper,r.style,t,i,e)}renderButtons(t,e,r,n,o=null){if(!document.querySelector(t)||this.isAlreadyRendered(t,o,n))return void f.renderButtons([t,o]);o&&(r.fundingSource=o);const i=()=>({style:e,...r,onClick:this.onSmartButtonClick,onInit:(e,r)=>{this.onSmartButtonsInit&&this.onSmartButtonsInit(e,r),this.handleOnButtonsInit(t,e,r)}});jQuery(document).off(this.reloadEventName,t).on(this.reloadEventName,t,((e,r={},n)=>{if(o&&n&&n!==o)return;const a=c()(this.defaultSettings,r);let u=(t=>{let e={};for(const n in t)Object.prototype.hasOwnProperty.call(t,n)&&(e[(r=n,r.replace(/([-_]\w)/g,(function(t){return t[1].toUpperCase()})))]=t[n]);var r;return e})(a.url_params);u=c()(u,a.script_attributes),function(t,e){if(void 0===e&&(e=Promise),p(t,e),"undefined"==typeof document)return e.resolve(null);var r=function(t){var e="https://www.paypal.com/sdk/js";t.sdkBaseUrl&&(e=t.sdkBaseUrl,delete t.sdkBaseUrl);var r,n,o=t,i=Object.keys(o).filter((function(t){return void 0!==o[t]&&null!==o[t]&&""!==o[t]})).reduce((function(t,e){var r,n=o[e].toString();return r=function(t,e){return(e?"-":"")+t.toLowerCase()},"data"===(e=e.replace(/[A-Z]+(?![a-z])|[A-Z]/g,r)).substring(0,4)?t.dataAttributes[e]=n:t.queryParams[e]=n,t}),{queryParams:{},dataAttributes:{}}),a=i.queryParams,u=i.dataAttributes;return a["merchant-id"]&&-1!==a["merchant-id"].indexOf(",")&&(u["data-merchant-id"]=a["merchant-id"],a["merchant-id"]="*"),{url:"".concat(e,"?").concat((r=a,n="",Object.keys(r).forEach((function(t){0!==n.length&&(n+="&"),n+=t+"="+r[t]})),n)),dataAttributes:u}}(t),n=r.url,o=r.dataAttributes,i=o["data-namespace"]||"paypal",a=l(i);return function(t,e){var r=document.querySelector('script[src="'.concat(t,'"]'));if(null===r)return null;var n=s(t,e),o=r.cloneNode();if(delete o.dataset.uidAuto,Object.keys(o.dataset).length!==Object.keys(n.dataset).length)return null;var i=!0;return Object.keys(o.dataset).forEach((function(t){o.dataset[t]!==n.dataset[t]&&(i=!1)})),i?r:null}(n,o)&&a?e.resolve(a):function(t,e){void 0===e&&(e=Promise),p(t,e);var r=t.url,n=t.attributes;if("string"!=typeof r||0===r.length)throw new Error("Invalid url.");if(void 0!==n&&"object"!=typeof n)throw new Error("Expected attributes to be an object.");return new e((function(t,e){if("undefined"==typeof document)return t();!function(t){var e=t.onSuccess,r=t.onError,n=s(t.url,t.attributes);n.onerror=r,n.onload=e,document.head.insertBefore(n,document.head.firstElementChild)}({url:r,attributes:n,onSuccess:function(){return t()},onError:function(){var t=new Error('The script "'.concat(r,'" failed to load.'));return window.fetch?fetch(r).then((function(r){return 200===r.status&&e(t),r.text()})).then((function(t){var r=function(t){var e=t.split("/* Original Error:")[1];return e?e.replace(/\n/g,"").replace("*/","").trim():t}(t);e(new Error(r))})).catch((function(t){e(t)})):e(t)}})}))}({url:n,attributes:o},e).then((function(){var t=l(i);if(t)return t;throw new Error("The window.".concat(i," global variable is not available."))}))}(u).then((e=>{f.setPaypal(e),f.registerButtons([t,o],i()),f.renderAll()}))})),this.renderedSources.add(t+(o??"")),"undefined"!=typeof paypal&&void 0!==paypal.Buttons&&(f.registerButtons([t,o],i()),f.renderButtons([t,o]))}isAlreadyRendered(t,e){return this.renderedSources.has(t+(e??""))}disableCreditCardFields(){this.creditCardRenderer.disableFields()}enableCreditCardFields(){this.creditCardRenderer.enableFields()}onButtonsInit(t,e,r){this.onButtonsInitListeners[t]=r?[]:this.onButtonsInitListeners[t]||[],this.onButtonsInitListeners[t].push(e)}handleOnButtonsInit(t,e,r){if(this.buttonsOptions[t]={data:e,actions:r},this.onButtonsInitListeners[t])for(let e of this.onButtonsInitListeners[t])"function"==typeof e&&e({wrapper:t,...this.buttonsOptions[t]})}disableSmartButtons(t){if(this.buttonsOptions[t])try{this.buttonsOptions[t].actions.disable()}catch(t){console.log("Failed to disable buttons: "+t)}}enableSmartButtons(t){if(this.buttonsOptions[t])try{this.buttonsOptions[t].actions.enable()}catch(t){console.log("Failed to enable buttons: "+t)}}}(null,t,(function(t,e){return e.reject()}),null);try{r.render({})}catch(t){console.error(t)}}}))}function u(){var t,e,n=jQuery('[name="ppcp[disable_funding][]"]'),o=n.length>0?n.val():PayPalCommerceGatewaySettings.disabled_sources,i=jQuery("#ppcpPayLaterButtonPreview"),a={"client-id":PayPalCommerceGatewaySettings.client_id,currency:PayPalCommerceGatewaySettings.currency,"integration-date":PayPalCommerceGatewaySettings.integration_date,components:["buttons","funding-eligibility","messages"],"enable-funding":["venmo","paylater"]};return"sandbox"===PayPalCommerceGatewaySettings.environment&&(a["buyer-country"]=PayPalCommerceGatewaySettings.country),null!=i&&i.length&&(o=Object.keys(PayPalCommerceGatewaySettings.all_funding_sources)),e=document.querySelector('[name="ppcp[pay_later_button_locations][]"]'),(r&&e?r.checked&&e.selectedOptions.length>0:PayPalCommerceGatewaySettings.is_pay_later_button_enabled)||(o=o.concat("credit")),null!==(t=o)&&void 0!==t&&t.length&&(a["disable-funding"]=o),a}function y(t){var r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:function(){};e(JSON.parse(JSON.stringify(t))).then((function(t){f.setPaypal(t),document.dispatchEvent(new CustomEvent("ppcp_paypal_script_loaded")),r(t)})).catch((function(t){return console.error("failed to load the PayPal JS SDK script",t)}))}function h(e,r){var n=e();t.on("change",":input",a((function(){var t=e();JSON.stringify(n)!==JSON.stringify(t)&&(r(t),n=t)}),300)),jQuery(document).on("ppcp_paypal_script_loaded",(function(){n=e(),r(n)})),r(n)}if(o&&o.addEventListener("change",(function(){d("#field-button_layout",!o.checked,"hide"),d("#field-button_general_layout",!o.checked,"hide")})),[{layoutSelector:"#ppcp-button_layout",taglineSelector:"#field-button_tagline",canHaveSeparateButtons:!0},{layoutSelector:"#ppcp-button_general_layout",taglineSelector:"#field-button_general_tagline",canHaveSeparateButtons:!0},{layoutSelector:"#ppcp-button_product_layout",taglineSelector:"#field-button_product_tagline"},{layoutSelector:"#ppcp-button_cart_layout",taglineSelector:"#field-button_cart_tagline"},{layoutSelector:"#ppcp-button_mini-cart_layout",taglineSelector:"#field-button_mini-cart_tagline"}].forEach((function(t){var e=document.querySelector(t.layoutSelector),r=document.querySelector(t.taglineSelector);if(e&&r){var n=function(){var n,i="horizontal"===jQuery(e).val()&&(!t.canHaveSeparateButtons||o&&!o.checked)&&!!((n=e.parentElement).offsetWidth||n.offsetHeight||n.getClientRects().length);d(r,i,"hide")};n(),jQuery(e).change(n),t.canHaveSeparateButtons&&o&&o.addEventListener("change",n)}})),document.querySelectorAll(".ppcp-preview").length){var v=u();t.on("change",":input",a((function(){var t=u();JSON.stringify(v)!==JSON.stringify(t)&&(y(t),v=t)}),1e3)),y(v,(function(){["product","cart","checkout","mini-cart","general"].forEach((function(t){var e="checkout"===t?"#ppcp-button":"#ppcp-button_"+t,r=t.charAt(0).toUpperCase()+t.slice(1),n={color:e+"_color",shape:e+"_shape",label:e+"_label",tagline:e+"_tagline",layout:e+"_layout"};"mini-cart"===t&&(n.height=e+"_height",r="MiniCart"),i((function(){return function(t,e){var r=jQuery(e.layout),n=r.length&&r.is(":visible")?r.val():"vertical",o={color:jQuery(e.color).val(),shape:jQuery(e.shape).val(),label:jQuery(e.label).val(),tagline:"horizontal"===n&&jQuery(e.tagline).is(":checked"),layout:n};return"height"in e&&(o.height=parseInt(jQuery(e.height).val())),{button:{wrapper:t,style:o},separate_buttons:{}}}("#ppcp"+r+"ButtonPreview",n)}))})),["product","cart","checkout","general"].forEach((function(t){var e="#ppcp-pay_later_"+t+"_message",r=t.charAt(0).toUpperCase()+t.slice(1);h((function(){return t={layout:e+"_layout",logo_type:e+"_logo",logo_position:e+"_position",text_color:e+"_color",flex_color:e+"_flex_color",flex_ratio:e+"_flex_ratio"},{wrapper:"#ppcp"+r+"MessagePreview",style:{layout:jQuery(t.layout).val(),logo:{type:jQuery(t.logo_type).val(),position:jQuery(t.logo_position).val()},text:{color:jQuery(t.text_color).val()},color:jQuery(t.flex_color).val(),ratio:jQuery(t.flex_ratio).val()},amount:30,placement:"product"};var t}),(function(t){var e=document.querySelector(t.wrapper);if(e){e.innerHTML="";var r=new class{constructor(t){this.config=t,this.optionsFingerprint=null,this.currentNumber=0}renderWithAmount(t){if(!this.shouldRender())return;const e={amount:t,placement:this.config.placement,style:this.config.style};if(document.querySelector(this.config.wrapper).getAttribute("data-render-number")!==this.currentNumber.toString()&&(this.optionsFingerprint=null),this.optionsEqual(e))return;const r=document.createElement("div");r.setAttribute("id",this.config.wrapper.replace("#","")),this.currentNumber++,r.setAttribute("data-render-number",this.currentNumber);const n=document.querySelector(this.config.wrapper),o=n.nextSibling;n.parentElement.removeChild(n),o.parentElement.insertBefore(r,o),f.registerMessages(this.config.wrapper,e),f.renderMessages(this.config.wrapper)}optionsEqual(t){const e=JSON.stringify(t);return this.optionsFingerprint===e||(this.optionsFingerprint=e,!1)}shouldRender(){return"undefined"!=typeof paypal&&void 0!==paypal.Messages&&void 0!==this.config.wrapper&&!!document.querySelector(this.config.wrapper)}}(t);try{r.renderWithAmount(t.amount)}catch(t){console.error(t)}}}))})),i((function(){return{button:{wrapper:"#ppcpPayLaterButtonPreview",style:{color:"gold",shape:"pill",label:"paypal",tagline:!1,layout:"vertical"}},separate_buttons:{}}}))}))}}))})()})();
//# sourceMappingURL=gateway-settings.js.map