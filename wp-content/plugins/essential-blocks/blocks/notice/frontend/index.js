!function(){function t(t){localStorage.hasOwnProperty("eb-notice-hidden-".concat(t))&&localStorage.removeItem("eb-notice-hidden-".concat(t))}function e(t){t.remove()}document.addEventListener("DOMContentLoaded",(function(n){for(var o,i=document.querySelectorAll(".eb-notice-wrapper"),a=function(){var n=i[c].querySelector(".eb-notice-dismiss");if(!n)return{v:void 0};i[c].style.position="relative",n.style.position="absolute",n.style.right="0px",n.style.top="0px";var o=i[c].getAttribute("data-id"),a=i[c].getAttribute("data-show-again"),r=localStorage.getItem("eb-notice-hidden-".concat(o));"true"===a&&t(o),"false"===a&&"1"===r&&e(i[c]),function(o){n.addEventListener("click",(function(){!function(n){var o=n.getAttribute("data-id"),i=n.getAttribute("data-show-again");"true"===i&&t(o),"false"===i&&function(t){localStorage.setItem("eb-notice-hidden-".concat(t),"1")}(o),e(n)}(i[o])}))}(c)},c=0;c<i.length;c++)if(o=a())return o.v}))}();