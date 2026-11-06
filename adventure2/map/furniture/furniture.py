from typing import Any

from .furniture_catalog import FurnitureCatalog
from ..primitives.coord import Coord
from .furniture_blueprints import FurnitureBlueprint
from ..primitives.height_difference import HeightDifference
from ..primitives.part import Part
from ..primitives.style import Style


class Furniture:
    blueprint: FurnitureBlueprint
    position: Coord
    nestled_furniture: list["Furniture"]

    @property
    def height_difference(self):
        return HeightDifference(
            self.position,
            self.blueprint.height_difference_size,
        )

    @property
    def part(self):
        return Part(
            self.position,
            self.blueprint.size,
            self.blueprint.css_classes,
            styles = [Style('--rotation', self.rotation)],
            divs = self.blueprint.divs,
            child_parts = [furniture.part for furniture in self.nestled_furniture],
        )

    @property
    def has_collision(self):
        return self.blueprint.has_collision
    
    def __init__(self, blueprint: FurnitureBlueprint, position: Coord, rotation: float, nestled_furniture: list["Furniture"]):
        self.blueprint = blueprint
        self.position = position
        self.rotation = rotation
        self.nestled_furniture = nestled_furniture

    @staticmethod
    def from_json(json: dict[str, Any]):
        blueprint = FurnitureCatalog.get_blueprint(json['furniture_type'])
        position = Coord.from_json(json['position'])
        rotation = float(json['rotation'])

        if "children" in json:
            children = [Furniture.from_json(child) for child in json["children"]]
        else:
            children = []

        return Furniture(blueprint, position, rotation, children)
