tinymce.PluginManager.add('hello', function(editor) {
	var postBreakClass = 'mce-postbreak', separatorHtml = editor.getParam('postbreak_separator', '<!-- postbreak -->');

	var postBreakSeparatorRegExp = new RegExp(separatorHtml.replace(/[\?\.\*\[\]\(\)\{\}\+\^\$\:]/g, function(a) {
		return '\\' + a;
	}), 'gi');

	var postbreakhtml = '<img src="' + tinymce.Env.transparentSrc + '" class="' +
		postBreakClass + '" data-mce-resize="false" />';

    editor.addCommand('AddPostBreak', function() {
        editor.insertContent(postbreakhtml);
    });

    editor.addButton('hello', {
        icon: 'moretag',
        tooltip: 'Post break',
        cmd: 'AddPostBreak'
    });

    editor.on('ResolveName', function(e) {
		if (e.target.nodeName == 'IMG' && editor.dom.hasClass(e.target, postBreakClass)) {
			e.name = 'postbreak';
		}
	});

	editor.on('click', function(e) {
		e = e.target;

		if (e.nodeName === 'IMG' && editor.dom.hasClass(e, postBreakClass)) {
			editor.selection.select(e);
		}
	});

	editor.on('BeforeSetContent', function(e) {
		e.content = e.content.replace(postBreakSeparatorRegExp, postbreakhtml);
	});

	editor.on('PreInit', function() {
		editor.serializer.addNodeFilter('img', function(nodes) {
			var i = nodes.length, node, className;

			while (i--) {
				node = nodes[i];
				className = node.attr('class');
				if (className && className.indexOf('mce-postbreak') !== -1) {
					// Replace parent block node if pagebreak_split_block is enabled
					var parentNode = node.parent;
					if (editor.schema.getBlockElements()[parentNode.name] && editor.settings.postbreak_split_block) {
						parentNode.type = 3;
						parentNode.value = separatorHtml;
						parentNode.raw = true;
						node.remove();
						continue;
					}

					node.type = 3;
					node.value = separatorHtml;
					node.raw = true;
				}
			}
		});
	});
});