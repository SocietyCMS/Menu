/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(1);


/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	__webpack_require__(2);

	__webpack_require__(3);

/***/ },
/* 2 */
/***/ function(module, exports) {

	'use strict';

	$('#tree1').tree({
	    autoOpen: true,
	    dragAndDrop: true,
	    onCanMove: function onCanMove(node) {
	        if (!node.parent.parent) {
	            return false;
	        }
	        return true;
	    },
	    onCanMoveTo: function onCanMoveTo(moved_node, target_node, position) {
	        if (!target_node.parent.parent && position != "inside") {
	            return false;
	        }
	        return true;
	    },
	    onCanSelectNode: function onCanSelectNode(node) {
	        if (!node.parent.parent) {
	            return false;
	        }
	        return true;
	    }
	});

	$('#tree1').bind('tree.select', function (event) {
	    if (event.node) {
	        // node was selected
	        var node = event.node;
	        console.log(node);
	    } else {
	        // event.node is null
	        // a node was deselected
	        // e.previous_node contains the deselected node
	    }
	}).bind('tree.move', function (event) {
	    var resource = Vue.resource('/api/menu/menu');
	    resource.save({ tree: $(this).tree('toJson') });
	});

	var resource = Vue.resource('/api/menu/menu');
	resource.get(function (response) {
	    $('#tree1').tree('loadData', response.data);
	});

/***/ },
/* 3 */
/***/ function(module, exports, __webpack_require__) {

	// style-loader: Adds some css to the DOM by adding a <style> tag

	// load the styles
	var content = __webpack_require__(4);
	if(typeof content === 'string') content = [[module.id, content, '']];
	// add the styles to the DOM
	var update = __webpack_require__(6)(content, {});
	if(content.locals) module.exports = content.locals;
	// Hot Module Replacement
	if(false) {
		// When the styles change, update the <style> tags
		if(!content.locals) {
			module.hot.accept("!!./../../../node_modules/css-loader/index.js!./../../../node_modules/postcss-loader/index.js!./Menu.scss", function() {
				var newContent = require("!!./../../../node_modules/css-loader/index.js!./../../../node_modules/postcss-loader/index.js!./Menu.scss");
				if(typeof newContent === 'string') newContent = [[module.id, newContent, '']];
				update(newContent);
			});
		}
		// When the module is disposed, remove the <style> tags
		module.hot.dispose(function() { update(); });
	}

/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

	exports = module.exports = __webpack_require__(5)();
	// imports


	// module
	exports.push([module.id, "ul.jqtree-tree {\n\n  list-style: none outside;\n  margin-left: 0;\n  margin-bottom: 0;\n  padding: 0;\n\n}\n\nul.jqtree-tree li.jqtree_common {\n\n  list-style: none outside;\n\n  margin-left: 0;\n\n  margin-bottom: 0;\n\n  padding: 0;\n\n}\n\nul.jqtree-tree li.jqtree_common span.jqtree-border {\n\n  position: absolute;\n\n  display: block;\n\n  left: -2px;\n\n  top: 0;\n\n  border: solid 2px #000;\n\n  border-radius: .28571429rem;\n\n  margin: 0;\n\n  box-sizing: content-box;\n\n}\n\nul.jqtree-tree li.jqtree_common.jqtree-moving > .jqtree-element.jqtree_common {\n\n  cursor: pointer;\n\n  position: relative;\n\n  box-shadow: 0 1px 2px 0 rgba(34, 36, 38, .15);\n\n  margin: 0.5rem 0;\n\n  padding: 0.5em;\n\n  border-radius: .28571429rem;\n\n  border: 1px solid rgba(34, 36, 38, .15);\n\n  background: #dcddde;\n\n  color: rgba(0, 0, 0, .6);\n\n}\n\nul.jqtree-tree .jqtree-toggler.jqtree-toggler-left {\n\n  margin-right: 0.5em;\n\n}\n\nul.jqtree-tree li.jqtree-ghost {\n\n  position: relative;\n\n  z-index: 10;\n\n  margin-right: 10px;\n\n}\n\nul.jqtree-tree li.jqtree-ghost span {\n\n  display: block;\n\n}\n\nul.jqtree-tree li.jqtree-ghost span.jqtree-circle {\n\n  border: solid 2px #000;\n\n  border-radius: 100px;\n\n  height: 8px;\n\n  width: 8px;\n\n  position: absolute;\n\n  top: -4px;\n\n  left: -6px;\n\n  box-sizing: border-box;\n\n}\n\nul.jqtree-tree li.jqtree-ghost span.jqtree-line {\n\n  background-color: #000;\n\n  height: 2px;\n\n  padding: 0;\n\n  position: absolute;\n\n  top: -1px;\n\n  left: 2px;\n\n  width: 100%;\n\n}\n\nul.jqtree-tree li.jqtree_common.jqtree-selected > .jqtree_common.jqtree-element {\n\n  border-top: 2px solid #2185d0;\n\n}\n\nul.jqtree-tree > li.jqtree_common {\n\n  padding-bottom: 1.4em;\n\n  position: relative;\n\n  background: #fff;\n\n  box-shadow: 0 1px 2px 0 rgba(34, 36, 38, .15);\n\n  margin: 1rem 0;\n\n  padding: 1em;\n\n  border-radius: .28571429rem;\n\n  border: 1px solid rgba(34, 36, 38, .15);\n\n  /* Root-Node */\n\n  /* Child-Nodes*/\n\n}\n\nul.jqtree-tree > li.jqtree_common:after, ul.jqtree-tree > li.jqtree_common:before {\n\n  content: '';\n\n  position: absolute;\n\n  bottom: -3px;\n\n  left: 0;\n\n  border-top: 1px solid rgba(34, 36, 38, .15);\n\n  background: rgba(0, 0, 0, .03);\n\n  width: 100%;\n\n  height: 6px;\n\n  visibility: visible;\n\n}\n\nul.jqtree-tree > li.jqtree_common:before {\n\n  bottom: 0;\n\n}\n\nul.jqtree-tree > li.jqtree_common > .jqtree-element {\n\n  font-size: 1.714rem;\n\n  border: none;\n\n  padding: 0;\n\n  font-family: Lato, 'Helvetica Neue', Arial, Helvetica, sans-serif;\n\n  font-weight: 700;\n\n  line-height: 1.2857em;\n\n  text-transform: none;\n\n}\n\nul.jqtree-tree > li.jqtree_common > ul.jqtree_common .jqtree-element {\n\n  cursor: pointer;\n\n  position: relative;\n\n  box-shadow: 0 1px 2px 0 rgba(34, 36, 38, .15);\n\n  margin: 0.5rem 0;\n\n  padding: 0.5em;\n\n  border-radius: .28571429rem;\n\n  border: 1px solid rgba(34, 36, 38, .15);\n\n  background: #f3f4f5;\n\n  color: rgba(0, 0, 0, .6);\n\n}\n\nspan.jqtree-dragging {\n  position: relative;\n  box-shadow: 0 1px 2px 0 rgba(34, 36, 38, .15);\n  margin: 0.5rem 0;\n  padding: 0.5em;\n  border-radius: .28571429rem;\n  border: 1px solid rgba(34, 36, 38, .15);\n  background: #f3f4f5;\n  color: rgba(0, 0, 0, .6);\n}", ""]);

	// exports


/***/ },
/* 5 */
/***/ function(module, exports) {

	/*
		MIT License http://www.opensource.org/licenses/mit-license.php
		Author Tobias Koppers @sokra
	*/
	// css base code, injected by the css-loader
	module.exports = function() {
		var list = [];

		// return the list of modules as css string
		list.toString = function toString() {
			var result = [];
			for(var i = 0; i < this.length; i++) {
				var item = this[i];
				if(item[2]) {
					result.push("@media " + item[2] + "{" + item[1] + "}");
				} else {
					result.push(item[1]);
				}
			}
			return result.join("");
		};

		// import a list of modules into the list
		list.i = function(modules, mediaQuery) {
			if(typeof modules === "string")
				modules = [[null, modules, ""]];
			var alreadyImportedModules = {};
			for(var i = 0; i < this.length; i++) {
				var id = this[i][0];
				if(typeof id === "number")
					alreadyImportedModules[id] = true;
			}
			for(i = 0; i < modules.length; i++) {
				var item = modules[i];
				// skip already imported module
				// this implementation is not 100% perfect for weird media query combinations
				//  when a module is imported multiple times with different media queries.
				//  I hope this will never occur (Hey this way we have smaller bundles)
				if(typeof item[0] !== "number" || !alreadyImportedModules[item[0]]) {
					if(mediaQuery && !item[2]) {
						item[2] = mediaQuery;
					} else if(mediaQuery) {
						item[2] = "(" + item[2] + ") and (" + mediaQuery + ")";
					}
					list.push(item);
				}
			}
		};
		return list;
	};


/***/ },
/* 6 */
/***/ function(module, exports, __webpack_require__) {

	/*
		MIT License http://www.opensource.org/licenses/mit-license.php
		Author Tobias Koppers @sokra
	*/
	var stylesInDom = {},
		memoize = function(fn) {
			var memo;
			return function () {
				if (typeof memo === "undefined") memo = fn.apply(this, arguments);
				return memo;
			};
		},
		isOldIE = memoize(function() {
			return /msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase());
		}),
		getHeadElement = memoize(function () {
			return document.head || document.getElementsByTagName("head")[0];
		}),
		singletonElement = null,
		singletonCounter = 0,
		styleElementsInsertedAtTop = [];

	module.exports = function(list, options) {
		if(false) {
			if(typeof document !== "object") throw new Error("The style-loader cannot be used in a non-browser environment");
		}

		options = options || {};
		// Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
		// tags it will allow on a page
		if (typeof options.singleton === "undefined") options.singleton = isOldIE();

		// By default, add <style> tags to the bottom of <head>.
		if (typeof options.insertAt === "undefined") options.insertAt = "bottom";

		var styles = listToStyles(list);
		addStylesToDom(styles, options);

		return function update(newList) {
			var mayRemove = [];
			for(var i = 0; i < styles.length; i++) {
				var item = styles[i];
				var domStyle = stylesInDom[item.id];
				domStyle.refs--;
				mayRemove.push(domStyle);
			}
			if(newList) {
				var newStyles = listToStyles(newList);
				addStylesToDom(newStyles, options);
			}
			for(var i = 0; i < mayRemove.length; i++) {
				var domStyle = mayRemove[i];
				if(domStyle.refs === 0) {
					for(var j = 0; j < domStyle.parts.length; j++)
						domStyle.parts[j]();
					delete stylesInDom[domStyle.id];
				}
			}
		};
	}

	function addStylesToDom(styles, options) {
		for(var i = 0; i < styles.length; i++) {
			var item = styles[i];
			var domStyle = stylesInDom[item.id];
			if(domStyle) {
				domStyle.refs++;
				for(var j = 0; j < domStyle.parts.length; j++) {
					domStyle.parts[j](item.parts[j]);
				}
				for(; j < item.parts.length; j++) {
					domStyle.parts.push(addStyle(item.parts[j], options));
				}
			} else {
				var parts = [];
				for(var j = 0; j < item.parts.length; j++) {
					parts.push(addStyle(item.parts[j], options));
				}
				stylesInDom[item.id] = {id: item.id, refs: 1, parts: parts};
			}
		}
	}

	function listToStyles(list) {
		var styles = [];
		var newStyles = {};
		for(var i = 0; i < list.length; i++) {
			var item = list[i];
			var id = item[0];
			var css = item[1];
			var media = item[2];
			var sourceMap = item[3];
			var part = {css: css, media: media, sourceMap: sourceMap};
			if(!newStyles[id])
				styles.push(newStyles[id] = {id: id, parts: [part]});
			else
				newStyles[id].parts.push(part);
		}
		return styles;
	}

	function insertStyleElement(options, styleElement) {
		var head = getHeadElement();
		var lastStyleElementInsertedAtTop = styleElementsInsertedAtTop[styleElementsInsertedAtTop.length - 1];
		if (options.insertAt === "top") {
			if(!lastStyleElementInsertedAtTop) {
				head.insertBefore(styleElement, head.firstChild);
			} else if(lastStyleElementInsertedAtTop.nextSibling) {
				head.insertBefore(styleElement, lastStyleElementInsertedAtTop.nextSibling);
			} else {
				head.appendChild(styleElement);
			}
			styleElementsInsertedAtTop.push(styleElement);
		} else if (options.insertAt === "bottom") {
			head.appendChild(styleElement);
		} else {
			throw new Error("Invalid value for parameter 'insertAt'. Must be 'top' or 'bottom'.");
		}
	}

	function removeStyleElement(styleElement) {
		styleElement.parentNode.removeChild(styleElement);
		var idx = styleElementsInsertedAtTop.indexOf(styleElement);
		if(idx >= 0) {
			styleElementsInsertedAtTop.splice(idx, 1);
		}
	}

	function createStyleElement(options) {
		var styleElement = document.createElement("style");
		styleElement.type = "text/css";
		insertStyleElement(options, styleElement);
		return styleElement;
	}

	function createLinkElement(options) {
		var linkElement = document.createElement("link");
		linkElement.rel = "stylesheet";
		insertStyleElement(options, linkElement);
		return linkElement;
	}

	function addStyle(obj, options) {
		var styleElement, update, remove;

		if (options.singleton) {
			var styleIndex = singletonCounter++;
			styleElement = singletonElement || (singletonElement = createStyleElement(options));
			update = applyToSingletonTag.bind(null, styleElement, styleIndex, false);
			remove = applyToSingletonTag.bind(null, styleElement, styleIndex, true);
		} else if(obj.sourceMap &&
			typeof URL === "function" &&
			typeof URL.createObjectURL === "function" &&
			typeof URL.revokeObjectURL === "function" &&
			typeof Blob === "function" &&
			typeof btoa === "function") {
			styleElement = createLinkElement(options);
			update = updateLink.bind(null, styleElement);
			remove = function() {
				removeStyleElement(styleElement);
				if(styleElement.href)
					URL.revokeObjectURL(styleElement.href);
			};
		} else {
			styleElement = createStyleElement(options);
			update = applyToTag.bind(null, styleElement);
			remove = function() {
				removeStyleElement(styleElement);
			};
		}

		update(obj);

		return function updateStyle(newObj) {
			if(newObj) {
				if(newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap)
					return;
				update(obj = newObj);
			} else {
				remove();
			}
		};
	}

	var replaceText = (function () {
		var textStore = [];

		return function (index, replacement) {
			textStore[index] = replacement;
			return textStore.filter(Boolean).join('\n');
		};
	})();

	function applyToSingletonTag(styleElement, index, remove, obj) {
		var css = remove ? "" : obj.css;

		if (styleElement.styleSheet) {
			styleElement.styleSheet.cssText = replaceText(index, css);
		} else {
			var cssNode = document.createTextNode(css);
			var childNodes = styleElement.childNodes;
			if (childNodes[index]) styleElement.removeChild(childNodes[index]);
			if (childNodes.length) {
				styleElement.insertBefore(cssNode, childNodes[index]);
			} else {
				styleElement.appendChild(cssNode);
			}
		}
	}

	function applyToTag(styleElement, obj) {
		var css = obj.css;
		var media = obj.media;
		var sourceMap = obj.sourceMap;

		if(media) {
			styleElement.setAttribute("media", media)
		}

		if(styleElement.styleSheet) {
			styleElement.styleSheet.cssText = css;
		} else {
			while(styleElement.firstChild) {
				styleElement.removeChild(styleElement.firstChild);
			}
			styleElement.appendChild(document.createTextNode(css));
		}
	}

	function updateLink(linkElement, obj) {
		var css = obj.css;
		var media = obj.media;
		var sourceMap = obj.sourceMap;

		if(sourceMap) {
			// http://stackoverflow.com/a/26603875
			css += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))) + " */";
		}

		var blob = new Blob([css], { type: "text/css" });

		var oldSrc = linkElement.href;

		linkElement.href = URL.createObjectURL(blob);

		if(oldSrc)
			URL.revokeObjectURL(oldSrc);
	}


/***/ }
/******/ ]);