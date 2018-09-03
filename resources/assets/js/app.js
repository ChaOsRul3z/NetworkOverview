$(function () {
    $('.pagination').addClass('justify-content-center');

    $('[data-toggle="tooltip"]').tooltip();
    // TOOLTIPSY OPTIONS FOR building_ and room_
    var options = {
        alignTo: 'cursor',
        offset: [10, 0],
        css: {
            'padding': '10px 12px',
            'border': '1px solid #777',
            'background-color': '#F5F5F5'
        }
    };

    $("g[id*='building_'], g[id*='room_']").click(function () {
        window.location.href = $(this).data('href');
        return false;
    }).tooltipsy(options);

    $(".open-DeleteModal").click(function () {
        $(".modal-header #title").text($(this).data('title'));
        $(".modal-body #body-text").text($(this).data('body'));
        $("#form-modal").attr('action', $(this).data('url'));
    });

    $('form').submit(function () {
        $(this).find('createPatchCableButton[type="submit"]').attr('disabled', 'disabled');
    });
    $("input[type='checkbox'][id*='vlan_']").change(function () {
        console.log(this.id);
        if ($("input[type='checkbox'][id=" + this.id + "]").is(':checked')) {
            $("." + this.id + " line").addClass('checked');
        } else {
            $("." + this.id + " line").removeClass('checked');
        }
    });

    // Javascript to enable link to tab
    var url = document.location.toString();
    if (url.match('#')) {
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
    }

    // Change hash for page-reload
    $('.nav-tabs a').on('shown.bs.tab', function (e) {
        window.location.hash = e.target.hash;
    });

//     $("input[type='checkbox'][id*='vlan_']").change(function () {
//         var g = $("." + this.id);
//         var classes = g.attr('class').split(" ");
//         console.log(classes.indexOf(this.id));
////         classes = classes.splice(, 1);
//         for (var x = 0; x < classes.length; x++)
//         {
//             $(classes[x]).prop("checked", false);
//         }
//         console.log(classes);
//         $("." + this.id + " line").toggleClass('hidden');
//     });

    var unitA = $('select#unitA');
    var unitB = $('select#unitB');

    if (unitA.length && unitB.length) {
        fillPorts(unitA.find(':selected').val(), unitA.attr('id').substr(-1));
        fillPorts(unitB.find(':selected').val(), unitB.attr('id').substr(-1));

        $('#unitB, #unitA').on('change', function (e) {
            fillPorts(e.target.value, e.target.id.substr(-1));
        });
    }

    function fillPorts(unitId, portId) {
        var ports = $('select#port' + portId);
        console.log(ports.length);
        $.get("/units/" + unitId + "/ports/ajax", function (data) {
            ports.empty();
            $.each(data, function (value, display) {
                ports.append($("<option></option>").attr("value", display.id).text(display.label));
            });
        });
    }
});