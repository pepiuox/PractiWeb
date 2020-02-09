/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function ()
{
    $(".items").draggable
            ({
                containment: 'document',
                opacity: 0.6,
                revert: 'invalid',
                helper: 'clone',
                zIndex: 100
            });

    $("#mycart").droppable({
        drop: function (e, ui)
        {
            var param = $(ui.draggable).attr('id');
            cart(param);
        }
    });
});

function cart(id)
{
    var ele = document.getElementById(id);
    var img_src = ele.getElementsByTagName("img")[0].src;
    var name = document.getElementById(id + "_name").value;
    var price = document.getElementById(id + "_price").value;

    $.ajax
            ({
                type: 'post',
                url: 'store_item.php',
                data: {
                    item_src: img_src,
                    item_name: name,
                    item_price: price
                },
                success: function (response) {
                    if (response)
                    {
                        document.getElementById("cart_label").innerHTML = response;
                        show_cart();
                    }
                }
            });
}

function remove_item(item_val)
{
    $.ajax({
        type: 'post',
        url: 'store_item.php',
        data: {
            remove_item: 'remove_item',
            item_val: item_val
        },
        success: function (response) {
            document.getElementById("cart_label").innerHTML = response;
            show_cart();
        }
    });
}

function show_cart()
{
    $.ajax({
        type: 'post',
        url: 'store_item.php',
        data: {
            show_cart: 'show_cart'
        },
        success: function (response) {
            document.getElementById("mycart").innerHTML = response;
        }
    });
}

