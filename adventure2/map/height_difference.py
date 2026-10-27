from math import sin, cos, radians

from .coord import Coord
from .size import Size


class HeightDifference:
    position: Coord
    size: Size
    rotation: float
    
    def __init__(self, position: Coord, size: Size):
        self.position = position
        self.size = size
        self.rotation = 45

    @property
    def _raw_x(self):
        return 'var(--movement-x)'

    @property
    def _raw_y(self):
        return 'var(--movement-y)'
        
    @property
    def _x(self):
        return str(cos(radians(self.rotation)))

    def get_calc(self) -> str:
        x_start = str(self.position.x)
        x_end = str(self.position.x + self.size.width)
        y_start = str(self.position.y)
        y_end = str(self.position.y + self.size.height)

        depth = str(self.size.depth ** (1/2))
        
        return f"""
        min(
            abs(
                min(
                    var(--movement-x) + {x_start},
                    0
                ) *
                max(
                    var(--movement-x) + {x_end},
                    0
                )
            ),
            {depth}
        ) *
        min(
            abs(
                min(
                    var(--movement-y) + {y_start},
                    0
                ) *
                max(
                    var(--movement-y) + {y_end},
                    0
                )
            ),
            {depth}
        )"""
