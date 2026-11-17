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
        self.rotation = 0

    @property
    def _raw_x(self):
        return 'var(--movement-x)'

    @property
    def _raw_y(self):
        return 'var(--movement-y)'

    @property
    def _x_mid(self):
        return self.position.x + self.size.width / 2

    @property
    def _y_mid(self):
        return self.position.y + self.size.height / 2

    @property
    def _x_trans(self):
        return f'({self._raw_x} + {self._x_mid})'

    @property
    def _y_trans(self):
        return f'({self._raw_y} + {self._y_mid})'
        
    @property
    def _x(self):
        return f'{self._x_trans} * {cos(self.rotation)} + {self._y_trans} * {sin(self.rotation)} - {self._x_mid}'

    @property
    def _y(self):
        return f'{self._y_trans} * {cos(self.rotation)} - {self._x_trans} * {sin(self.rotation)} - {self._y_mid}'

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
                    {self._x} + {x_start},
                    0
                ) *
                max(
                    {self._x} + {x_end},
                    0
                )
            ),
            {depth}
        ) *
        min(
            abs(
                min(
                    {self._y} + {y_start},
                    0
                ) *
                max(
                    {self._y} + {y_end},
                    0
                )
            ),
            {depth}
        )"""
