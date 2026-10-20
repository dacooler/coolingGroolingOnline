from typing import Iterable

from height_difference import HeightDifference


class HeightDifferences:
    height_differences: list[HeightDifference]

    def __init__(self, height_differences: Iterable[HeightDifference]):
        self.height_differences = list(height_differences)

    def get_calcs(self):
        return "max(" + ', '.join((diff.get_calc() for diff in self.height_differences)) + ")"