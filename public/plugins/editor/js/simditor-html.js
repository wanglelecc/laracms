(function (root, factory) {
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module unless amdModuleId is set
    define('simditor-html', ["jquery","simditor","html_beautify"], function (a0,b1,c2) {
      return (root['HTMLButton'] = factory(a0,b1,c2));
    });
  } else if (typeof exports === 'object') {
    // Node. Does not work with strict CommonJS, but
    // only CommonJS-like environments that support module.exports,
    // like Node.
    module.exports = factory(require("jquery"),require("simditor"),require("js_beautify"));
  } else {
    root['SimditorHTML'] = factory(jQuery,Simditor,html_beautify);
  }
}(this, function ($, Simditor, beautify) {

var HTMLButton,
  extend = function(child, parent) { for (var key in parent) { if (hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; },
  hasProp = {}.hasOwnProperty,
  slice = [].slice;

HTMLButton = (function(superClass) {
  extend(HTMLButton, superClass);

  function HTMLButton() {
    return HTMLButton.__super__.constructor.apply(this, arguments);
  }

  HTMLButton.prototype.name = 'html';

  HTMLButton.prototype.icon = 'html5';

  HTMLButton.prototype.needFocus = false;

  HTMLButton.prototype._init = function() {
    HTMLButton.__super__._init.call(this);
    this.editor.textarea.on('focus', (function(_this) {
      return function(e) {
        return _this.editor.el.addClass('focus').removeClass('error');
      };
    })(this));
    this.editor.textarea.on('blur', (function(_this) {
      return function(e) {
        _this.editor.el.removeClass('focus');
        return _this.editor.setValue(_this.editor.textarea.val());
      };
    })(this));
    return this.editor.textarea.on('input', (function(_this) {
      return function(e) {
        return _this._resizeTextarea();
      };
    })(this));
  };

  HTMLButton.prototype.status = function() {};

  HTMLButton.prototype.command = function() {
    var button, i, len, ref;
    this.editor.blur();
    this.editor.el.toggleClass('simditor-html');
    this.editor.htmlMode = this.editor.el.hasClass('simditor-html');
    if (this.editor.htmlMode) {
      this.editor.hidePopover();
      this.editor.textarea.val(this.beautifyHTML(this.editor.textarea.val()));
      this._resizeTextarea();
    } else {
      this.editor.setValue(this.editor.textarea.val());
    }
    ref = this.editor.toolbar.buttons;
    for (i = 0, len = ref.length; i < len; i++) {
      button = ref[i];
      if (button.name === 'html') {
        button.setActive(this.editor.htmlMode);
      } else {
        button.setDisabled(this.editor.htmlMode);
      }
    }
    return null;
  };

  HTMLButton.prototype.beautifyHTML = function() {
    var args;
    args = 1 <= arguments.length ? slice.call(arguments, 0) : [];
    if (beautify.html) {
      return beautify.html.apply(beautify, args);
    } else {
      return beautify.apply(null, args);
    }
  };

  HTMLButton.prototype._resizeTextarea = function() {
    this._textareaPadding || (this._textareaPadding = this.editor.textarea.innerHeight() - this.editor.textarea.height());
    return this.editor.textarea.height(this.editor.textarea[0].scrollHeight - this._textareaPadding);
  };

  return HTMLButton;

})(Simditor.Button);

Simditor.Toolbar.addButton(HTMLButton);

return HTMLButton;

}));
