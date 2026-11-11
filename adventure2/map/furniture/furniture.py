from typing import Any

from .furniture_catalog import FurnitureCatalog
from ..primitives.coord import Coord
from .furniture_blueprints import FurnitureBlueprint
from ..primitives.html_element import HtmlElement
from ..primitives.height_difference import HeightDifference
from ..primitives.part import Part
from ..primitives.style import Style


class Furniture:
    blueprint: FurnitureBlueprint
    position: Coord
    rotation: float
    children: list["Furniture"]

    def translate(self, translation: Coord):
        self.position += translation

    @property
    def height_difference(self):
        return HeightDifference(
            self.position,
            self.blueprint.height_difference_size,
        )

    def part(self, is_edit_mode: bool):
        return Part(
            self.position,
            self.blueprint.size,
            self.blueprint.css_classes,
            styles = [Style('--rotation', self.rotation)],
            divs = self.blueprint.divs,
            child_parts = [furniture.part(is_edit_mode) for furniture in self.children],
            tag = 'form' if is_edit_mode else 'div',
            child_divs_constructor = lambda: (HtmlElement('div', [HtmlElement('button')]) if is_edit_mode else HtmlElement('div')),
        )

    @property
    def has_collision(self):
        return self.blueprint.has_collision
    
    def __init__(self, blueprint: FurnitureBlueprint, position: Coord, rotation: float, children: list["Furniture"]):
        self.blueprint = blueprint
        self.position = position
        self.rotation = rotation
        self.children = children

    @staticmethod
    def from_json(json: dict[str, Any], parent_rotation: float = 0):
        blueprint = FurnitureCatalog.get_blueprint(json['furniture_type'])
        position = Coord.from_json(json['position'])
        rotation = float(json['rotation']) + parent_rotation

        if "children" in json:
            children = [Furniture.from_json(child, rotation) for child in json["children"]]
        else:
            children = []

        return Furniture(blueprint, position, rotation, children)
