var data = [
    {
        label: 'Main', id: 1,
        children: [
            {label: 'About Us', id: 2},
            {label: 'Contact', id: 3},
            {label: 'Support', id: 4}
        ]
    },
    {
        label: 'Footer', id: 5,
        children: [
            {label: 'About Us', id: 6},
            {label: 'Contact', id: 7},
            {label: 'Support', id: 8}
        ]
    }
];

$('#tree1').tree({
    data: data,
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
);
