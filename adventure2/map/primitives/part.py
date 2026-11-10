from typing import Callable

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
    child_parts: list["Part"]
    tag: str
    child_divs_constructor: Callable[[], HtmlElement]

    def __init__(
            self,
            position: Coord,
            size: Size,
            css_classes: list[str],
            args: list[str] = [],
            styles: list[Style] = [],
            divs: int = 5,
            child_parts: list["Part"] = [],
            tag: str = 'div',
            child_divs_constructor: Callable[[], HtmlElement] = lambda: HtmlElement()):
        self.position = position
        self.css_classes = css_classes
        self.args = args
        self.divs = divs
        self.size = size
        self.styles = styles
        self.child_parts = child_parts
        self.tag = tag
        self.child_divs_constructor = child_divs_constructor

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

        children = [self.child_divs_constructor() for _ in range(self.divs)]

        children[-1].children.extend((part.get_visual_cube() for part in self.child_parts))

        return HtmlElement(
            tag = self.tag,
            css_classes=['cubed'] + self.css_classes,
            style=style,
            children=children
        )
        
    def clone(self):
        return Part(self.position.clone(), self.size.clone(), list(self.css_classes), list(self.args), list(self.styles), self.divs)
