from .html_element import HtmlElement
from .coord import Coord
from .size import Size
from .style import Style


class Part:
    """Class representing a single part. Has a visual cube and a collision rect."""
    position: Coord
    css_classes: list[str]
    args: list[str]
    divs: int
    size: Size
    styles: list[Style]

    def __init__(self, position: Coord, size: Size, css_classes: list[str], args: list[str] = [], styles: list[Style] = [], divs: int = 5):
        self.position = position
        self.css_classes = css_classes
        self.args = args
        self.divs = divs
        self.size = size
        self.styles = styles

    def get_collision_rect(self):
        """The collision rect of this part. Will be just a simple rectangle div."""
        return HtmlElement(
            'div',
            style=self.styles + [
                Style('left', self.position.x, 'px'),
                Style('top', self.position.y, 'px'),
                Style('width', self.size.width, 'px'),
                Style('height', self.size.height, 'px'),
            ]
        )

    def get_visual_cube(self):
        """The visual component of this part. Will be a cube with a certain texture."""
        style = self.styles + [
            Style('left', self.position.x, 'px'),
            Style('top', self.position.y, 'px'),
            Style('--width', self.size.width, 'px'),
            Style('--height', self.size.height, 'px'),
            Style('--depth', self.size.depth, 'px'),
        ] + [
            Style(f'--arg{i}', arg, '') for i, arg in enumerate(self.args)
        ]

        return HtmlElement(
            css_classes=['cubed'] + self.css_classes,
            style=style,
            children=[HtmlElement('div') for _ in range(self.divs)]
        )
        
    def clone(self):
        return Part(self.position.clone(), self.size.clone(), list(self.css_classes), list(self.args), list(self.styles), self.divs)
