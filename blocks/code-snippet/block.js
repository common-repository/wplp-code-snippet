/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {

    function jsUcfirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    var PanelBody = wp.components.PanelBody;
    var InspectorControls = wp.editor.InspectorControls;
    var SelectControl = wp.components.SelectControl;
    wp.blocks.registerBlockType('wplp/code-snippet-box', {
        title: 'Code Snippet Beautifier',
        icon: 'editor-justify',
        category: 'common',
        attributes: {
            content: {
                type: 'string'
            },
            source: {
                type: 'string',
                default: 'html'
            },
        },
        edit: function (props) {
            function updateContent(event) {
                props.setAttributes({
                    content: event.target.value
                })
            }

            function updateSource(value) {
                props.setAttributes({
                    source: value
                })
            }

            return [
                wp.element.createElement(
                    "div", {
                        class: "code_box_wrap",
                    },
                    wp.element.createElement(
                        "label", {
                            "class": "wplp_code_snippet_label"
                        },
                        jsUcfirst(props.attributes.source) + " Code Snippet "
                    ),
                    wp.element.createElement("textarea", {
                        class: "code_text_box",
                        rows: "7",
                        cols: "55",
                        onChange: updateContent
                    }, props.attributes.content),
                ),
                wp.element.createElement(
                    InspectorControls,
                    null,
                    wp.element.createElement(
                        PanelBody, {
                            title: 'Snippet Settings',
                            initialOpen: true
                        },
                        wp.element.createElement(SelectControl, {
                            label: 'Source',
                            value: props.attributes.source,
                            options: [{
                                label: 'HTML',
                                value: 'html'
                            }, {
                                label: 'Javascript',
                                value: 'javascript'
                            }, {
                                label: 'CSS',
                                value: 'css'
                            }, {
                                label: 'PHP',
                                value: 'php'
                            }, {
                                label: 'SQL',
                                value: 'sql'
                            }],
                            onChange: updateSource,
                        }),
                    ),
                ),
            ];

        },
        save: function (props) {
            return wp.element.createElement(
                "div",
                null,
                props.attributes.content,
            );
        }
    })
    /**/
})(jQuery);