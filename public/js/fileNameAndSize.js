function GetFileSizeNameAndType(e)
        {
        var fi = document.getElementById('files');

        var totalFileSize = 0;
        var _URL = window.URL || window.webkitURL;
        if (fi.files.length > 0)
        {

            
            for (var i = 0; i <= fi.files.length - 1; i++)
            {
                var fsize = fi.files.item(i).size;
                totalFileSize = totalFileSize + fsize;
                document.getElementById('fp').innerHTML =
                document.getElementById('fp').innerHTML
                +
                '<br /> ' + fi.files.item(i).name
                +
                '</b> <b>' + Math.round((fsize / 1024)) + '</b> KB';

            }
        }
        document.getElementById("UpdateProfile").removeAttribute("hidden");
        document.getElementById('divTotalSize').innerHTML = "Total File(s) Size is <b>" + Math.round(totalFileSize / 1024) + "</b> KB";

    }
