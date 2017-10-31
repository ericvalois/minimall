/**
 * dependsOn v1.0.0
 * a jQuery plugin to facilitate the handling of form field dependsOn.
 *
 * Copyright 2012 David Street
 * Licensed under the MIT license.
 */

(function (c) {

    var dependsOn = function (e, f) {
        this.selector = e;
        this.$dependencyObj = c(e);
        this.qualifiers = f
    };
    dependsOn.prototype.enabled = function (e) {
        if (c(this.selector + "[disabled]").length > 0) {
            if (e) {
                return false
            }
        } else {
            if (!e) {
                return false
            }
        }
        return true
    };
    dependsOn.prototype.checked = function (e) {
        if (this.$dependencyObj.attr("type") === "checkbox") {
            if ((!this.$dependencyObj.is(":checked") && e) || (this.$dependencyObj.is(":checked") && !e)) {
                return false
            }
        }
        return true
    };

    dependsOn.prototype.values = function (value) {

        var master_value = this.$dependencyObj.val(),
                flag = false;

                
        if (this.$dependencyObj.attr('type') == 'checkbox') {
            master_value = this.$dependencyObj.is(':checked') ? 1 : 0;
           
        } else if (this.$dependencyObj.data('type') == 'checkbox' && typeof master_value == 'string') {
            if (master_value != '') {
                master_value = master_value.split(',');
            }
        }
        

        if (this.$dependencyObj.attr("type") === "radio") {
            master_value = this.$dependencyObj.filter(":checked").val();
        }

        if (typeof value == 'string' || typeof value == 'number') {
            value = [value];
        }

        for (var i = 0; i < value.length; i++) {

            if (typeof (master_value) === "array" || typeof (master_value) === "object") {

                if (master_value.indexOf(value[i]) >= 0) {
                    flag = true;
                    break
                }
            } else {
                if (value[i] === master_value) {
                    flag = true;
                    break
                }
            }
        }
        return flag;
    };

    dependsOn.prototype.not = function (e) {

        var h = this.$dependencyObj.val(),
                g = e.length,
                f = 0;


        for (f; f < g; f += 1) {
            if (e[f] === h) {
                return false
            }
        }
        return true
    };

    dependsOn.prototype.match = function (e) {
        var g = this.$dependencyObj.val(),
                f = e;
        return f.test(g)
    };

    dependsOn.prototype.contains = function (e) {

        var g = this.$dependencyObj.val(),
                f = 0;
        if (typeof (g) === "array" || typeof (g) === "object") {
            for (f in e) {
                if (c.inArray(e[f], g) !== -1) {
                    return true
                }
            }
        } else {
            return this.values(e)
        }
        return false
    };
    dependsOn.prototype.email = function (f) {
        var e = /^[_a-zA-Z0-9\-]+(\.[_a-zA-Z0-9\-]+)*@[a-zA-Z0-9\-]+(\.[a-zA-Z0-9\-]+)*\.(([0-9]{1,3})|([a-zA-Z]{2,3})|(aero|coop|info|museum|name))$/;
        return (this.match(e) === f)
    };
    
    dependsOn.prototype.url = function (e) {
        var f = /(((http|ftp|https):\/\/)|www\.)[\w\-_]+(\.[\w\-_]+)+([\w\-\.,@?\^=%&:\/~\+#!]*[\w\-\@?\^=%&\/~\+#])?/g;
        return (this.match(f) === e)
    };
    
    dependsOn.prototype.doesQualify = function () {
        var e = 0;
        for (e in this.qualifiers) {
            if (dependsOn.prototype.hasOwnProperty(e) && typeof (dependsOn.prototype[e]) === "function") {
                if (!this[e](this.qualifiers[e])) {
                    return false
                }
            } else {
                if (typeof (this.qualifiers[e] === "function")) {
                    return this.qualifiers[e](this.$dependencyObj.val())
                }
            }
        }
        return true
    };
    
    var a = function (e) {
        var f = 0;
        this.dependencies = [];
        for (f in e) {
            this.dependencies.push(new dependsOn(f, e[f]))
        }
    };
    
    a.prototype.doesQualify = function () {
        var f = this.dependencies.length,
                g = 0,
                e = true;
        for (g; g < f; g += 1) {
            if (!this.dependencies[g].doesQualify()) {
                e = false;
                break
            }
        }
        return e
    };
    
    var b = function (e, g, f) {
        this.dependencySets = [];
        this.$subject = e;
        this.settings = c.extend({
            dependsOnisable: false,
            hide: true,
            dependsOnuration: 200,
            onEnable: function () {},
            onDisable: function () {}
        }, f);
        this.enableCallback = function () {};
        this.disableCallback = function () {};
        this.init(g)
    };
    b.prototype.init = function (e) {
        this.addSet(e);
        this.check(true)
    };
    b.prototype.addSet = function (j) {
        var f = this,
                e = 0,
                h = 0,
                i = 0,
                g;
        this.dependencySets.push(new a(j));
        e = this.dependencySets.length - 1;
        h = this.dependencySets[e].dependencies.length;
        for (i; i < h; i += 1) {
            g = this.dependencySets[e].dependencies[i];
            g.$dependencyObj.on("change", function () {
                f.check()
            });
            if (g.$dependencyObj.attr("type") === "text") {
                g.$dependencyObj.on("keypress", function (k) {
                    if (k.which && g.$dependencyObj.is(":focus")) {
                        f.check()
                    }
                })
            }
        }
    };
    b.prototype.or = function (e) {
        this.addSet(e);
        this.check(false);
        return this
    };
    b.prototype.enable = function (e) {
        var h = this.$subject,
                g = this.$subject.attr("id"),
                f;
        if (this.settings.hasOwnProperty("valueTarget") && this.settings.valueTarget !== undefined) {
            h = c(this.settings.valueTarget)
        } else {
            if (this.$subject[0].nodeName.toLowerCase() !== "input" && this.$subject[0].nodeName.toLowerCase() !== "textarea" && this.$subject[0].nodeName.toLowerCase() !== "select") {
                h = this.$subject.find("input, textarea, select")
            }
        }
        if (this.settings.disable) {
            this.$subject.removeAttr("disabled")
        }
        if (this.settings.hide) {
            f = this.$subject.closest('.tpfw_form_row');

            if (f.css("display") === "none") {
                f.show();
            }
        }
        if (this.settings.hasOwnProperty("valueOnEnable") && this.settings.valueOnEnable !== undefined) {
            h.val(this.settings.valueOnEnable)
        }
        if (this.settings.hasOwnProperty("checkOnEnable")) {
            if (this.settings.checkOnEnable) {
                h.attr("checked", "checked")
            } else {
                h.removeAttr("checked")
            }
        }
        if (this.settings.hasOwnProperty("toggleClass") && this.settings.toggleClass !== undefined) {
            this.$subject.addClass(this.settings.toggleClass)
        }
        this.settings.onEnable()
    };
    b.prototype.disable = function (e) {
        var h = this.$subject,
                g = this.$subject.attr("id"),
                f;
        if (this.settings.hasOwnProperty("valueTarget") && this.settings.valueTarget !== undefined) {
            h = c(this.settings.valueTarget)
        } else {
            if (this.$subject[0].nodeName.toLowerCase() !== "input" && this.$subject[0].nodeName.toLowerCase() !== "textarea" && this.$subject[0].nodeName.toLowerCase() !== "select") {
                h = this.$subject.find("input, textarea, select")
            }
        }
        if (this.settings.disable) {
            this.$subject.attr("disabled", "disabled")
        }
        if (this.settings.hide) {
            f = this.$subject.closest('.tpfw_form_row');
            f.hide();
        }
        if (this.settings.hasOwnProperty("valueOnDisable") && this.settings.valueOnDisable !== undefined) {
            h.val(this.settings.valueOnDisable)
        }
        if (this.settings.hasOwnProperty("checkOnDisable")) {
            if (this.settings.checkOnDisable) {
                h.attr("checked", "checked")
            } else {
                h.removeAttr("checked")
            }
        }
        if (this.settings.hasOwnProperty("toggleClass") && this.settings.toggleClass !== undefined) {
            this.$subject.removeClass(this.settings.toggleClass)
        }
        this.settings.onDisable()
    };
    b.prototype.check = function (h) {
        var g = this.dependencySets.length,
                f = 0,
                e = false;
        for (f; f < g; f += 1) {
            if (this.dependencySets[f].doesQualify()) {
                e = true;
                break
            }
        }
        if (e) {
            this.enable(h)
        } else {
            this.disable(h)
        }
    };

    c.fn.dependsOn = function (g, e) {
        var f = new b(this, g, e);
        return f;
    }
})(jQuery);