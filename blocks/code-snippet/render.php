<?php

function wplp_codeSnippetOutput($props) {

    $source = isset($props['source']) ? $props['source'] : 'html';
    $html = '<pre class="' . $props['className'] . ' language-' . $source . ' line-numbers"><code class="language-' . $source . '">' . $props['content'] . '</code></pre>';
    if ($source == 'html') {
        $source = 'markup';
        $html = '<pre class="' . $props['className'] . ' language-' . $source . ' line-numbers"><code class="language-' . $source . '">' . esc_html($props['content']) . '</code></pre>';
    }
    return $html;
}

register_block_type('wplp/code-snippet-box', array(
    'render_callback' => 'wplp_codeSnippetOutput',
));

