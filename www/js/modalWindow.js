function openModalWindow(id,width,height){
                if (typeof(width) == "undefined"){ var width = 500; }
                if (typeof(height) == "undefined"){ var height = 450; }
                var last;
                var dialogOptions = {
                    "title": "Detail položky",
                    "width": width,
                    "height": height,
                    "minWidth": width,
                    "minHeight": height,
                    "modal": false,
                    "resizable": true,
                    "draggable": true,
                    "cancel": false,
                    "position": {"my": "center top", "at": "center bottom", "of": "button"},
                    "close": function () {
                        if (last != this) {
                            $(last).dialog("destroy").remove();
                        }
                    }
                };
                var dialogExtendOptions = {
                    "closable": true,
                    "maximizable": false,
                    "minimizable": false,
                    "minimizeLocation": "left",
                    "collapsable": false,
                    "dblclick": "maximize",
                    "titlebar": false
                };
                last = $(id).dialog(dialogOptions).dialogExtend(dialogExtendOptions);
                maxwidth = $('html').css('max-width');

                if (maxwidth == '1200px') {
                    last.dialogExtend('maximize');
                }

                $("select").chosen();
                $('span.ui-dialog-title').each(function () {
                    var $p = $(this);
                    $p.html($p.html().replace(/^(\w+)/, '<strong>$1</strong>'));
                });            
    }