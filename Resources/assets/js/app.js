
$('#tree1').tree({
    autoOpen: true,
    dragAndDrop: true,
    onCanMove: function (node) {
        if (!node.parent.parent) {
            return false;
        }
        return true;
    },
    onCanMoveTo: function (moved_node, target_node, position) {
        if (!target_node.parent.parent && position != "inside") {
            return false;
        }
        return true;
    },
    onCanSelectNode: function (node) {
        if (!node.parent.parent) {
            return false;
        }
        return true;
    }
});

$('#tree1').bind(
    'tree.select',
    function (event) {
        if (event.node) {
            // node was selected
            var node = event.node;
            console.log(node);
        }
        else {
            // event.node is null
            // a node was deselected
            // e.previous_node contains the deselected node
        }
    }
).bind(
    'tree.move',
    function(event) {
        var resource = Vue.resource('/api/menu/menu');
        resource.save({tree: $(this).tree('toJson')});
    }
);


var resource = Vue.resource('/api/menu/menu');
resource.get(function(response) {
    $('#tree1').tree('loadData',response.data);
});
