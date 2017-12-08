
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="jquery-3.2.1.min.js"></script>
	<style type="text/css">
	 #uploads {
      display:block;
      position:relative;
  } 

  #uploads li {
      list-style:none;
  }

  #drop {
      width: 90%;
      height: 100px;
      padding: 0.5em;
      float: left;
      margin: 10px;
      border: 8px dotted grey;
  }

  #drop.hover {
      border: 8px dotted green;
  }

  #drop.err {
      border: 8px dotted orangered;
  }</style>


</head>
<body>

<div id="drop" class="drop-area ui-widget-header">
  <div class="drop-area-label">Drop image here</div>
</div>
<br />
<form id="upload">
  <input type="file" name="file" id="file" multiple="true" accepts="image/*" />
  <ul class="gallery-image-list" id="uploads">
    <!-- The file uploads will be shown here -->
  </ul>
</form>
<div id="listTable"></div>
<script type="text/javascript">var display = $("#uploads"); // cache `#uploads`, `this` at `$.ajax()`
var droppable = $("#drop")[0]; // cache `#drop` selector
$.ajaxSetup({
    context: display,
    contentType: "application/json",
    dataType: "json",
    beforeSend: function (jqxhr, settings) {
        // pre-process `file`
        var file = JSON.parse(
                   decodeURIComponent(settings.data.split(/=/)[1])
                   );
        // add `progress` element for each `file`
        var progress = $("<progress />", {
                "class": "file-" + (!!$("progress").length 
                         ? $("progress").length 
                         : "0"),
                "min": 0,
                "max": 0,
                "value": 0,
                "data-name": file.name
        });
        this.append(progress, file.name + "<br />");
        jqxhr.name = progress.attr("class"); 
    }
});

var processFiles = function processFiles(event) {
    event.preventDefault();
    // process `input[type=file]`, `droppable` `file`
    var files = event.target.files || event.dataTransfer.files;
    var images = $.map(files, function (file, i) {
        var reader = new FileReader();
        var dfd = new $.Deferred();
        reader.onload = function (e) {
            dfd.resolveWith(file, [e.target.result])
        };
        reader.readAsDataURL(new Blob([file], {
            "type": file.type
        }));
        return dfd.then(function (data) {
            return $.ajax({
                type: "POST",
                url: "/echo/json/",
                data: {
                    "file": JSON.stringify({
                            "file": data,
                            "name": this.name,
                            "size": this.size,
                            "type": this.type
                    })
                },
                xhr: function () {
                    // do `progress` event stuff
                    var uploads = this.context;
                    var progress = this.context.find("progress:last");
                    var xhrUpload = $.ajaxSettings.xhr();
                    if (xhrUpload.upload) {
                        xhrUpload.upload.onprogress = function (evt) {
                            progress.attr({
                                    "max": evt.total,
                                    "value": evt.loaded
                            })
                        };
                        xhrUpload.upload.onloadend = function (evt) {
                            var progressData = progress.eq(-1);
                            console.log(progressData.data("name")
                                    + " upload complete...");
                            var img = new Image;
                            $(img).addClass(progressData.eq(-1)
                            .attr("class"));
                            img.onload = function () {
                                if (this.complete) {
                                  console.log(
                                      progressData.data("name")
                                      + " preview loading..."
                                  );
                                };

                            };
                        uploads.append("<br /><li>", img, "</li><br />");
                        };
                    }
                    return xhrUpload;
                }
            })
            .then(function (data, textStatus, jqxhr) {
                console.log(data)
                this.find("img[class=" + jqxhr.name + "]")
                .attr("src", data.file)
                .before("<span>" + data.name + "</span><br />");
                return data
            }, function (jqxhr, textStatus, errorThrown) {
                console.log(errorThrown);
                return errorThrown
            });
        })
    });
    $.when.apply(display, images).then(function () {
        var result = $.makeArray(arguments);
        console.log(result.length, "uploads complete");
    }, function err(jqxhr, textStatus, errorThrown) {
        console.log(jqxhr, textStatus, errorThrown)
    })
};

$(document)
.on("change", "input[name^=file]", processFiles);
// process `droppable` events
droppable.ondragover = function () {
    $(this).addClass("hover");
    return false;
};

droppable.ondragend = function () {
    $(this).removeClass("hover")
    return false;
};

droppable.ondrop = function (e) {
    $(this).removeClass("hover");
    var image = Array.prototype.slice.call(e.dataTransfer.files)
        .every(function (img, i) {
        return /^image/.test(img.type)
    });
    e.preventDefault();
    // if `file`, file type `image` , process `file`
    if (!!e.dataTransfer.files.length && image) {
            $(this).find(".drop-area-label")
            .css("color", "blue")
            .html(function (i, html) {
            $(this).delay(3000, "msg").queue("msg", function () {
                $(this).css("color", "initial").html(html)
            }).dequeue("msg");
            return "File dropped, processing file upload...";
        });
        processFiles(e);
    } else {
            // if dropped `file` _not_ `image`
            $(this)
            .removeClass("hover")
            .addClass("err")
            .find(".drop-area-label")
            .css("color", "darkred")
            .html(function (i, html) {
            $(this).delay(3000, "msg").queue("msg", function () {
                $(this).css("color", "initial").html(html)
                .parent("#drop").removeClass("err")
            }).dequeue("msg");
            return "Please drop image file...";
        });
    };
};</script>
</body>
</html>