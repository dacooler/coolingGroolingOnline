from typing import Any


class Style:
    property: str
    value: Any
    unit: str

    def __init__(self, property: str, value: Any, unit: str=''):
        self.property = property
        self.value = value
        self.unit = unit

    def __str__(self):
        return f'{self.property}: {self.value}{self.unit};'