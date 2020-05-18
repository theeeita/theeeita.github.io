"use strict";function Carousel(t){const{root:e,outerClass:s="",draggable:i=!1,loop:o=!0,duration:a=750,itemClass:n="",autoplay:r=!0,autoplayDelay:l=2e3,nav:c=!0,navClass:d="",buttons:h=!0,buttonsClass:_="",nextButtonClass:m="",prevButtonClass:u="",nextButtonHTML:p="nextItem",prevButtonHTML:v="prevItem",dots:y=!0,dotsClass:g="",dotItemClass:f=""}=t||{};if(!e)return;const A=this,x=createElement("div",{className:`carousel-container${s?` ${s}`:""}`}),E=createElement("div",{className:"carousel"}),I={width:e.offsetWidth,height:e.offsetHeight};A._isMoving=!1,A._movedByDot=!1,A._isPaused=!r,A._browserDelay=navigator.userAgent.includes("Firefox")?100:0,A._autoplayTimerId=null,A._autoplayDelay=l,A._loop=o,A._duration=a,A._startIndex=0,A._offsetWidth=I.width,A._items=getElementsArray(e.children),A._itemsCount=A._items.length,A._storage=createElement("div",{className:"carousel-items-list"}),A._controls={active:c,dots:y},applySizes(I,E,...A._items);for(const t of A._items)addClasses(t,"carousel-item",n);if(A._items[0].classList.add("active"),e.insertAdjacentElement("beforeBegin",x),x.append(E),E.append(e),e.append(A._storage),A._storage.append(...A._items),x.append(E),x.style.width=`${I.width}px`,c){const t=createElement("div",{className:`carousel-nav${d?` ${d}`:""}`});if(x.append(t),h){const e=createElement("div",{className:`carousel-buttons${_?` ${_}`:""}`}),s=createElement("button",{className:`carousel-next${m?` ${m}`:""}`,html:p,"data-action":"next"}),i=createElement("button",{className:`carousel-prev${u?` ${u}`:""}`,html:v,"data-action":"prev"});e.append(i,s),t.append(e)}if(y){const e=createElement("div",{className:`carousel-dots${g?` ${g}`:""}`});let s=0,i=A._items.length;for(;s<i;){const t=createElement("span",{className:`carousel-dot-item${f?` ${f}`:""}`,"data-action":"moveAt","data-order":s});e.append(t),s++}A._dots=getElementsArray(e.children),A._dots[0].classList.add("active"),t.append(e)}x.addEventListener("click",function(t){const e=t.target.closest("[data-action]");if(e){const t=e.dataset.action;"moveAt"===t?A[t](+e.dataset.order):A[t]()}})}i&&x.addEventListener("mousedown",function(t=window.event){t.preventDefault();const e=t.target.closest(".carousel-items-list"),s=t.pageX;function i(t){s<t.pageX-35&&(A.prev(),e.removeEventListener("mousemove",i)),s>t.pageX+35&&(A.next(),e.removeEventListener("mousemove",i))}e&&(e.addEventListener("mousemove",i),e.addEventListener("mouseup",function(){e.removeEventListener("mousemove",i)}))}),r&&A.play()}function getElementsArray(t,e=document){return"string"==typeof t?Array.from(e.querySelectorAll(t)):Array.from(t)}function addClasses(t,...e){for(const s of e)""===s||void 0===s||t.classList.contains(s)||t.classList.add(s)}function applySizes(t,...e){for(const s of e)for(const[e,i]of Object.entries(t))s.style[e]=`${i}px`}function createElement(t,e){const s=document.createElement(t);for(const[t,i]of Object.entries(e))switch(t){case"className":s.className=i;break;case"html":s.innerHTML=i;break;case"text":s.textContent=i;break;default:s.setAttribute(t,i)}return s}Carousel.prototype={play(){null===this._autoplayTimerId&&(this._isPaused=!1,this._autoplayTimerId=setTimeout(()=>{this._autoplayTimerId=setInterval(this.next.bind(this),this._autoplayDelay)},0))},pause(){this._isPaused||(clearInterval(this._autoplayTimerId),this._autoplayTimerId=null,this._isPaused=!0,this._isMoving=!1,this._movedByDot=!1)},next(){this._movedByDot||this._isMoving||this._startIndex+1>this._itemsCount-1&&!this._loop||(this._startIndex=this._startIndex+1>this._itemsCount-1?0:this._startIndex+1,this._isMoving=!0,this._storage.style.transition=`left ${this._duration/1e3}s ease`,this._storage.style.left=`-${this._offsetWidth}px`,setTimeout(()=>{const t=getElementsArray(this._storage.querySelectorAll(".carousel-item"))[0];this._storage.append(t),this._storage.style.transition="none",this._storage.style.left="0",this._isMoving=!1,this._pointSlideActive()},this._duration),this._pointDotActive(this._startIndex))},prev(){if(this._movedByDot||this._isMoving||this._startIndex-1<0&&!this._loop)return;this._startIndex=this._startIndex-1<0?this._itemsCount-1:this._startIndex-1,this._isMoving=!0,this._storage.style.transition="none";const t=getElementsArray(this._storage.querySelectorAll(".carousel-item"))[this._itemsCount-1],e=getElementsArray(this._storage.querySelectorAll(".carousel-item"))[0].cloneNode(!0);e.classList.add("clone"),this._storage.prepend(t,e),this._storage.style.left=`-${this._offsetWidth}px`,setTimeout(()=>{this._storage.style.transition=`left ${this._duration/1e3}s ease`,e.remove(),setTimeout(()=>this._storage.style.left="0",0)},this._browserDelay),setTimeout(()=>{this._isMoving=!1,this._pointSlideActive()},this._duration),this._pointDotActive(this._startIndex)},moveAt(t){if(this._isMoving||this._movedByDot)return;this._movedByDot=!0,this._storage.style.transition=`left ${this._duration/1e3}s ease`;const e=this._startIndex,s=t,i=Math.abs(e-s),o=this._offsetWidth*i;if(e<s&&(this._storage.style.left=`-${o}px`,setTimeout(()=>{const t=getElementsArray(this._storage.querySelectorAll(".carousel-item")).slice(0,i);this._storage.append(...t),this._storage.style.transition="none",this._storage.style.left="0",this._startIndex=s,this._movedByDot=!1,this._pointSlideActive()},this._duration)),e>s){this._storage.style.transition="none";const t=getElementsArray(this._storage.querySelectorAll(".carousel-item")).slice(-i),e=getElementsArray(this._storage.querySelectorAll(".carousel-item"))[0].cloneNode(!0);e.classList.add("clone"),this._storage.prepend(...t,e),this._storage.style.left=`-${o}px`,setTimeout(()=>{this._storage.style.transition=`left ${this._duration/1e3}s ease`,e.remove(),setTimeout(()=>this._storage.style.left="0",0)},this._browserDelay),setTimeout(()=>{this._startIndex=s,this._movedByDot=!1,this._pointSlideActive()},this._duration)}this._pointDotActive(s)},_pointDotActive(t){this._controls.active&&this._controls.dots&&this._dots.forEach((e,s)=>s===t?e.classList.add("active"):e.classList.remove("active"))},_pointSlideActive(){getElementsArray(this._storage.querySelectorAll(".carousel-item")).forEach((t,e)=>0===e?t.classList.add("active"):t.classList.remove("active"))}};