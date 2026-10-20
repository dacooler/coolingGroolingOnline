from style import Style


class HtmlElement:
    tag: str = 'div'
    children: list['HtmlElement']
    styles: list[Style]
    css_classes: list[str]

    def __init__(self, tag: str = 'div', children: list['HtmlElement'] = [], style: list[Style] = [], css_classes: list[str] = []):
        if tag: self.tag = tag

        if children:
            self.children = children
        else:
            self.children = []

        if style:
            self.styles = style
        else:
            self.styles = []

        if css_classes:
            self.css_classes = css_classes
        else:
            self.css_classes = []

    def __str__(self):
        name = f'<{self.tag}'

        if self.css_classes:
            name += ' class="'
            for css_class in self.css_classes:
                name += css_class + " "
            name += '"'
        
        if self.styles:
            name += ' style="'
            for style in self.styles:
                name += str(style) + " "
            name += '"'

        name += '>'
        for child in self.children:
            name += '\n'
            name += str(child)
        if self.children: name += '\n'

        name += f'</{self.tag}>'

        return name


# ===================== TESTS ========================

if __name__ == '__main__':
    child = HtmlElement(
        'p',
        style=[
            Style('width', 100, 'px'),
            Style('height', 200, 'rm'),
        ],
        css_classes=['my-css-style']
    )

    parent = HtmlElement(
        'div',
        css_classes=[
            'my-class-1',
            'my-class-2',
        ],
        children=[
            child,
            child,
            child,
        ],
    )

    print(str(parent))