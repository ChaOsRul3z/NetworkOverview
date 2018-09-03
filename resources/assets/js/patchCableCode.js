let portA;
let portB;

let portAId;
let portBId;

const portALabel = $('.test-box .portA span');
const portBLabel = $('.test-box .portB span');

const CSRF_TOKEN = $('meta[name="_token"]').attr('content');
const status = $('span#status');

const createPatchCableButton = $('#createPatchCable');

createPatchCableButton.click(createPatchCable);

function portClicked() {
    const SELECTED = 'selected';

    if ($(this).hasClass('port--used')) {
        return;
    }

    function toggleCreateButton() {
        if ((portA !== undefined && portA.hasClass(SELECTED)) && (portB !== undefined && portB.hasClass(SELECTED))) {
            createPatchCableButton.prop('disabled', false);
        } else {
            createPatchCableButton.prop('disabled', true);
        }
    }

    // Check if A == undefined OR check if This == B
    if (portA === undefined && portB === undefined) {
        portA = $(this);
        portALabel.html(portA.data('id'));
        portA.addClass(SELECTED);
        toggleCreateButton();
        return;
    } else if (portA === undefined && portB !== undefined) {
        if ($(this).data('id') !== portB.data('id')) {
            portA = $(this);
            portALabel.html(portA.data('id'));
            portA.addClass(SELECTED);
            toggleCreateButton();
            return;
        }
    } else {
        // if A is assigned = check if A == this and set A to undefined
        if ($(this).data('id') === portA.data('id')) {
            portALabel.empty();
            portA.removeClass(SELECTED);
            portA = undefined;
            toggleCreateButton();
            return;
        }
    }

    // Check if B == undefined OR check if This == A
    if (portB === undefined && portA !== undefined) {
        if ($(this).data('id') !== portA.data('id')) {
            portB = $(this);
            portBLabel.html(portB.data('id'));
            portB.addClass(SELECTED);
            toggleCreateButton();
            return;
        }
    } else {
        // if A is assigned = check if A == this and set A to undefined
        if ($(this).data('id') === portB.data('id')) {
            portBLabel.empty();
            portB.removeClass(SELECTED);
            portB = undefined;
            toggleCreateButton();
            return;
        }
    }
}

$('rect.port').click(portClicked);

function createPatchCable() {
    if (portA !== undefined && portB !== undefined) {
        portAId = portA.data('id');
        portBId = portB.data('id');

        if (portAId === parseInt(portAId, 10) && portBId === parseInt(portBId, 10)) {
            $.ajax({
                type: 'POST',
                url: "/patchcables",
                data: {_token: CSRF_TOKEN, portA_id: portAId, portB_id: portBId},
                timeout: 5000,
                success: function (data) {
                    status.text(data.msg);
                    setTimeout(function () {
                        status.empty();
                    }, 2000);
                },
                error: function (xhr, textStatus, errorThrown) {
                    console.log(xhr);
                    console.log(textStatus);
                    console.log(errorThrown);
                }
            });
        }
    }
}


function deletePatchCable() {
    let patchcableId = $('span#patchcableId').text();

    if (parseInt(patchcableId, 10)) {
        $.ajax({
            type: 'DELETE',
            url: "/patchcables/" + patchcableId,
            data: {_token: CSRF_TOKEN},
            timeout: 5000,
            success: function (data) {
                console.log(data);
                status.text(data.msg);
                setTimeout(function () {
                    status.empty();
                }, 2000);
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(xhr);
                console.log(textStatus);
                console.log(errorThrown);
            }
        });
    }
}

let deletePatchcableId = $('#deletePatchCableSection span#patchcableId');

let deletePatchCableButton = $('button#deletePatchCable');


deletePatchCableButton.click(deletePatchCable);

function removePortFromSelectableList() {
    let classToRemove = 'port';
    let classToAdd = 'port--used';

    portAId = $(this).data('portaid');
    let portABasedOnId = $("rect[data-id=" + portAId + "]");

    portABasedOnId.removeClass(classToRemove);
    portABasedOnId.addClass(classToAdd);

    portBId = $(this).data('portbid');
    let portBBasedOnId = $("rect[data-id=" + portBId + "]");
    portBBasedOnId.removeClass(classToRemove);
    portBBasedOnId.addClass(classToAdd);
}

let patchcables = $("g[id^='patchcable_']");

$.each(patchcables, removePortFromSelectableList);

patchcables.click(function () {
    const patch_selected = "patch--selected";
    let patchcable = $(this);

    let patchSection = $('#deletePatchCableSection');

    if (!patchcable.hasClass(patch_selected)) {
        patchcable.addClass(patch_selected);
        patchSection.css('display', 'block');
    } else {
        patchcable.removeClass(patch_selected);
        patchSection.css('display', 'none');
    }

    patchCableId = $(this).data("patchcableid");
    deletePatchcableId.html(patchCableId);
    deletePatchCableButton.prop('disabled', false);
});

$(document).on('input', '#patchcable-range', function () {
    let value = $(this).val();
    let patchcables = $("g[id^='patchcable_']");

    switch (value) {
        case "0":
            patchcables.each(function (index, element) {
                $(element).removeClass("show");
                $(element).addClass("hide");
            });
            break;
        case "1":
            patchcables.each(function (index, element) {
                $(element).removeClass("show");
                $(element).removeClass("hide");
            });
            break;
        case "2":
            patchcables.each(function (index, element) {
                $(element).removeClass("hide");
                $(element).addClass("show");
            });
            break;
    }
});