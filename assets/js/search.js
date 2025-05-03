function removeHighlights() {
    const highlights = document.querySelectorAll('.highlighted-text');
    highlights.forEach(span => {
        const parent = span.parentNode;
        parent.replaceChild(document.createTextNode(span.textContent), span);
        parent.normalize(); // merges text nodes
    });
}

function highlightMatches(query) {
    const allTextNodes = [];
    const walker = document.createTreeWalker(document.body, NodeFilter.SHOW_TEXT, null, false);

    while (walker.nextNode()) {
        allTextNodes.push(walker.currentNode);
    }

    for (let textNode of allTextNodes) {
        const parent = textNode.parentNode;
        if (parent && parent.className !== 'search-input' && textNode.nodeValue.toLowerCase().includes(query)) {
            const originalText = textNode.nodeValue;
            const regex = new RegExp(`(${query})`, 'gi');
            const newHTML = originalText.replace(regex, `<span class="highlighted-text">$1</span>`);
            const tempElement = document.createElement('span');
            tempElement.innerHTML = newHTML;
            parent.replaceChild(tempElement, textNode);
        }
    }
}

function searchAndScroll() {
    removeHighlights(); // clear previous highlights
    const query = document.getElementById('searchBox').value.toLowerCase().trim();
    if (!query) return;
    highlightMatches(query);

    const firstMatch = document.querySelector('.highlighted-text');
    if (firstMatch) {
        firstMatch.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

document.getElementById("searchBox").addEventListener("keydown", function(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        searchAndScroll();
    }
});