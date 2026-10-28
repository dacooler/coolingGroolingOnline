from typing import Any

from ..size import Size


class FurnitureBlueprint:
    size: Size
    has_collision: bool
    height_difference_size: Size
    css_classes: list[str]
    divs: int

    def __init__(self, size: Size, has_collision: bool, height_difference_depth: int, css_classes: list[str], divs: int = 5):
        self.size = size
        self.has_collision = has_collision
        self.height_difference_size = self.size.clone()
        self.height_difference_size.depth = height_difference_depth
        self.css_classes = css_classes
        self.divs = divs
    
    @staticmethod
    def from_json(json: dict[str, Any]):
        size = Size.from_json(json['size'])
        has_collision = json['has_collision']

        if not has_collision:
            height_difference = json['height_difference']
        else:
            height_difference = 0
        css_classes = json['css_classes']

        try:
            divs = json['divs']
        except KeyError:
            divs = 5

        return FurnitureBlueprint(size, has_collision, height_difference, css_classes, divs)
 
