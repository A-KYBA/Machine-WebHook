import type { Machine } from '../../../types/machine';
import StateBadge from '../../atoms/StateBadge/StateBadge';
import styles from './MachineCard.module.css';

function MachineCard({ name, state, watchers }: Machine) {
  return (
    <div className={styles.card}>
      <span className={styles.name}>{name}</span>
      {watchers && watchers.length > 0 && <span className={styles.watchers}>Also watching: {watchers.join(', ')}</span>}
      <StateBadge state={state} />
    </div>
  );
}

export default MachineCard;
