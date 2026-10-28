from typing import Any

from .furniture_catalog import FurnitureCatalog
from ..coord import Coord
from .furniture_blueprints import FurnitureBlueprint
from ..height_difference import HeightDifference
from ..sized_part import SizedPart
from ..style import Style


class Furniture:
    blueprint: FurnitureBlueprint
    position: Coord

    @property
    def height_difference(self):
        return HeightDifference(
            self.position,
            self.blueprint.height_difference_size,
        )

    @property
    def part(self):
        return SizedPart(
            self.position,
            self.blueprint.size,
            self.blueprint.css_classes,
            styles=[Style('--rotation', self.rotation)],
            divs=self.blueprint.divs
        )

    @property
    def has_collision(self):
        return self.blueprint.has_collision
    
    def __init__(self, blueprint: FurnitureBlueprint, position: Coord, rotation: float):
        self.blueprint = blueprint
        self.position = position
        self.rotation = rotation

    @staticmethod
    def from_json(json: dict[str, Any]):
        blueprint = FurnitureCatalog.get_blueprint(json['furniture_type'])
        position = Coord.from_json(json['position'])
        rotation = float(json['rotation'])
        return Furniture(blueprint, position, rotation)
