from .coord import Coord
from .html_element import HtmlElement
from .style import Style


class Part:
    """Class representing a single part without size (the size gets set in the css instead (trust))."""
    position: Coord
    css_classes: list[str]
    args: list[str]

    def __init__(self, position: Coord, css_classes: list[str], args: list[str] = []):
        self.position = position
        self.css_classes = css_classes
        self.args = args

    def get_collision_rect(self):
        """The collision rect of this part. Will be just a simple rectangle div."""
        return HtmlElement(
            'div',
            style=[
                Style('left', self.position.x, 'px'),
                Style('top', self.position.y, 'px'),
            ]
        )

    def get_visual_cube(self):
        """The visual component of this part. Will be a cube with a certain texture."""
        style=[
            Style('left', self.position.x, 'px'),
            Style('top', self.position.y, 'px'),
        ] + [
            Style(f'--arg{i}', arg, '') for i, arg in enumerate(self.args)
        ]

        return HtmlElement(
            css_classes=['cubed'] + self.css_classes,
            style=style,
            children=[HtmlElement('div') for _ in range(6)]
        )

    def clone(self):
        return Part(self.position.clone(), list(self.css_classes), list(self.args))
